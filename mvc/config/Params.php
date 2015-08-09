<?php

namespace Config;

use I18n\I18n;
use Models\Post;
use Libs\Env;

class Params {

	/**
	 * Return all params.
	 * This class is for to separate the code and not put it
	 * all into the controller.
	 *
	 * @return array
	 */
	public static function all() {
		return [

			/*
			 * ====================================
			 * Params to pages
			 * ====================================
			 */
			'pages' => [
				'excludeSlugs' => [
					'ajax',
					'lang',
					'random'
				]
			],

			/*
			 * ====================================
			 * Params to all templates
			 * ====================================
			 */
			'globalVars' => [
				'adminEmail' => ADMIN_EMAIL,
				'atomUrl' => get_bloginfo('atom_url'),

				'blogAuthor' => 'José María Valera Reales',
				'blogCharset' => get_bloginfo('charset'),
				'blogCommentsAtomUrl' => get_bloginfo('comments_atom_url'),
				'blogCommentsRss2Url' => get_bloginfo('comments_rss2_url'),
				'blogDescription' => ($d = I18n::trans('internal.blog_description')) ? $d : get_bloginfo('description'),
				'blogHtmlType' => get_bloginfo('html_type'),
				'blogLanguage' => get_bloginfo('language'),
				'blogLoginUrl' => wp_login_url($_SERVER['REQUEST_URI']),
				'blogKeywords' => 'knob, wordpress, framework, mvc, template, mustache, php',
				'blogPingbackUrl' => get_bloginfo('pingback_url'),
				'blogPostsPerPage' => get_option('posts_per_page'),
				'blogName' => get_bloginfo('name'),
				'blogRdfUrl' => get_bloginfo('rdf_url'),
				'blogRss2Url' => get_bloginfo('rss2_url'),
				'blogRssUrl' => get_bloginfo('rss_url'),
				'blogTitle' => BLOG_TITLE,
				'blogStylesheetDirectory' => get_bloginfo('stylesheet_directory'),
				'blogStylesheetUrl' => get_bloginfo('stylesheet_url'),
				'blogTagBase' => ($t = get_option('tag_base')) ? $t : Post::TAG_BASE_DEFAULT,
				'blogTemplateDirectory' => get_bloginfo('template_directory'),
				'blogTemplateUrl' => get_bloginfo('template_url'),
				'blogTextDirection' => get_bloginfo('text_direction'),
				'blogVersion' => get_bloginfo('version'),
				'blogWpurl' => get_bloginfo('wpurl'),

				'categoryBase' => ($c = get_option('category_base')) ? $c : Post::CATEGORY_BASE_DEFAULT,
				'componentsDir' => COMPONENTS_DIR,
				'currentLang' => I18n::getLangBrowserByCurrentUser(),
				'currentLangFullname' => I18n::getLangFullnameBrowserByCurrentUser(),

				'homeUrl' => get_home_url(),

				'isEnvProd' => Env::isProd(),
				'isEnvDev' => Env::isDev(),
				'isEnvLoc' => Env::isLoc(),
				'isUserLoggedIn' => is_user_logged_in(),

				'publicDir' => PUBLIC_DIR,

				'tagBase' => ($t = get_option('tag_base')) ? $t : Post::TAG_BASE_DEFAULT
			]
		];
	}
}