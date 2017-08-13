<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

/*
	视图合成器类
 */
class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        // Dependencies automatically resolved by service container...
        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //composer方法给需要渲染的视图通过with方法添加属性
        $view->with('count', $this->users->count());
        $view->with('viewcomposer',"我是视图合成器");
    }
}
?>