<?php

namespace Controllers;

use Models\Post;
use Models\User;
use I18n\I18n;

/**
 * Home Controller
 *
 * @author José María Valera Reales
 */
class HomeController extends BaseController {

	/**
	 * author.php
	 */
	public function getAuthor() {
		$author = get_queried_object();
		$user = User::find($author->ID);
		if (!$user) {
			return $this->get404();
		}
		$args = [
			'user' => $user
		];
		return $this->renderPage('author', $args);
	}

	/**
	 * category.php
	 */
	public function getCategory() {
		$cat = get_queried_object();
		$args = [
			'thingType' => I18n::transu('category'),
			'thingToSearch' => $cat->name,
			'posts' => Post::getByCategory($cat->term_id)
		];
		return $this->renderPage('search', $args);
	}

	/**
	 * home.php
	 */
	public function getHome() {
		$args = [
			'posts' => Post::getAll(get_option('posts_per_page'))
		];
		return $this->renderPage('home', $args);
	}

	/**
	 * 404.php
	 */
	public function get404() {
		return $this->renderPage('error_404');
	}

	/**
	 * search.php
	 */
	public function getSearch() {
		$searchQuery = get_search_query();
		$args = [
			'thingToSearch' => $searchQuery,
			'posts' => Post::getBySearch($searchQuery)
		];
		return $this->renderPage('search', $args);
	}

	/**
	 * single.php
	 */
	public function getSingle($type = 'post') {
		if (have_posts()) {
			the_post();
			$post = Post::find(get_the_ID());
		}
		if (!isset($post)) {
			return $this->get404();
		}
		return $this->renderPage($type, [
			$type => $post
		]);
	}

	/**
	 * tag.php
	 */
	public function getTag() {
		$tag = get_queried_object();
		$args = [
			'thingType' => I18n::transu('tag'),
			'thingToSearch' => $tag->name,
			'posts' => Post::getByTag($tag->term_id)
		];
		return $this->renderPage('search', $args);
	}
}
