<?php

namespace Models;

/**
 *
 * @author chema
 */
class Archive {

	/*
	 * Members
	 */
	private $text;
	private $url;

	/*
	 * Constructor
	 */
	public function __construct($text, $url) {
		$this->text = $text;
		$this->url = $url;
	}

	/**
	 *
	 * @return string
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Return monthly
	 *
	 * @link https://core.trac.wordpress.org/browser/tags/4.2.2/src/wp-includes/general-template.php#L1335
	 * @return string
	 */
	public static function getMonthly() {
		global $wpdb, $wp_locale;

		$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts
			FROM $wpdb->posts
			WHERE post_type = 'post' AND post_status = 'publish'
			GROUP BY YEAR(post_date), MONTH(post_date)
			ORDER BY post_date $order $limit";

		$key = md5($query);
		$key = "wp_get_archives:$key:$last_changed";
		if (!$results = wp_cache_get($key, 'posts')) {
			$results = $wpdb->get_results($query);
			wp_cache_set($key, $results, 'posts');
		}
		$archives = [ ];
		foreach ( $results as $result ) {
			$url = get_month_link($result->year, $result->month);
			/* translators: 1: month name, 2: 4-digit year */
			$text = sprintf(__('%1$s %2$d'), $wp_locale->get_month($result->month), $result->year);
			$archives[] = new Archive($text, $url);
		}

		return $archives;
	}
}
