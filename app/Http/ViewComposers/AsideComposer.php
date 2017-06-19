<?php
namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use App\Repositories\UserRepository;
use App\Event;
/**
* 
*/
class AsideComposer{
	public function compose(View $view ){
		$events=Event::all()->where('status','=','activo');
		$view->with('events',$events);

	}
}