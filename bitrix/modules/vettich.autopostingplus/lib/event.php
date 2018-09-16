<?
namespace Vettich\AutopostingPlus;
use Vettich\Autoposting\PostingFunc;

class Event
{
	static function OnPost($params)
	{
		$posts = Func::GetPosts();
		foreach($posts as $post)
		{
			$obj = 'Vettich\AutopostingPlus\Posts\\'.$post.'\Event';
			if(method_exists($obj, 'OnPost'))
				$obj::OnPost($params);
		}
		return true;
	}

	static function OnGetPosts($params)
	{
		$prefix = '\Vettich\AutopostingPlus\Posts\\';
		foreach(Func::GetPosts() as $post)
		{
			$p = $prefix.$post;
			$params['posts'][] = $post;
			$params['mod_params'][$post] = array(
				'posting' => $p.'\Posting',
				'option' => $p.'\Option',
				'func' => $p.'\Func',
				'event' => $p.'\Event',
			);
		}
		return true;
	}
}