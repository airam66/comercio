<?php
namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use App\Repositories\UserRepository;

/**
* 
*/
class AsideComposerStatus{
	public function compose(View $view ){
		$status=collect(['pendiente','proceso','preparado','entregado']);
		$view->with('status',$status);

	}
}