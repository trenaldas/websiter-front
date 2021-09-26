<?php

namespace App\Http\Middleware;

use App\Models\Bit;
use App\Models\Project;
use App\Models\Tag;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SetProjectVariables
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $project = Project::where('domain_url', request()->getHost())
            ->orWhere('subdomain_url', str_replace('.websiter.com', '', request()->getHost()))
            ->whereActive(true)
            ->firstOrFail();

        $sessionId = Session::get('websiter-cart');
        $cartCount = $sessionId
            ? $cart = $project->carts->where('session_id', $sessionId)->count()
            : 0;

        $activeId = $this->getActiveMenuId(request()->route()->parameters);

        View::composer('layouts.app', function ($view) use ($project, $activeId, $cartCount) {
            $view->with('cartCount', $cartCount);
            $view->with('project', $project);
            $view->with('activeId', $activeId);
            $view->with(
                'navTags',
                $project->tags->where('active', 1)->whereNull('parent_id')
            );
        });

        return $next($request);
    }

    private function getActiveMenuId(array $requestParameters): int
    {
        foreach ($requestParameters as $parameter => $id) {
            if ($parameter === 'tag') {
                $tag = Tag::find($id);
                return $tag->parent_id ?? $id;
            }

            if ($parameter === 'bit') {
                $bit = Bit::find($id);
                if ($bit->parent_id > 0) {
                    $parentBit = Bit::find($bit->parent_id);

                    return $parentBit->tag_id;
                }

                return $bit->tag_id;
            }
        }

        return 0;
    }

}
