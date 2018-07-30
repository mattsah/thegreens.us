<?php
/**
 * Created by PhpStorm.
 * User: mher
 * Date: 5/14/18
 * Time: 4:26 PM
 */


include_once 'ecwd-single-event.php';

class ecwd_events_controller {

  public function __construct(){
  }


  public function create_event(){
    //insert post
  }

  public function update_post(){
    //title, contet, etc
  }

  public function get_events(){
    include_once 'ecwd-events-query.php';
    $ecwd_query = new ecwd_events_query();


    //$ecwd_query->filter_by_taxonomies(array(25, 26), array(23));
    //    $ecwd_query->filter_by_calendars(['143', '166']);
    //    $ecwd_query->filter_by_venues(['51','145']);
    //    $ecwd_query->filter_by_organizers(['153','142']);
    //    $ecwd_query->filter_by_post_status(['publish','private']);
    //    $ecwd_query->search('');
    $ecwd_query->filter_by_date('2018-07-01', '2018-07-31');
    //$ecwd_query->meta_query_relation('AND');

    $single_events_list = array();
    $events = $ecwd_query->get_posts();
    $events_id = array();

    foreach($events as $event) {

      $single_event = new ecwd_single_event($event->ID, $event->post_title, $event->post_content);
      $single_event->post = $event;
      $single_event->set_permalink();
      $single_event->set_featured_image_url();
      $single_event->set_categories();
      $single_event->set_tags();
      $single_event->set_metas();

      $single_events_list[$event->ID] = $single_event;
    }
  }

  /**
   * @param $ev ecwd_single_event
   * */
  public function update_meta_values($ev){

    update_post_meta($ev->id, 'ecwd_event_date_from', $this->sanitize_text($ev->get_start_date()));
    update_post_meta($ev->id, 'ecwd_event_date_to', $this->sanitize_text($ev->get_end_date()));
    if($ev->get_all_day() === true) {
      update_post_meta($ev->id, 'ecwd_all_day_event', '1');
    } else {
      delete_post_meta($ev->id, 'ecwd_all_day_event');
    }
    update_post_meta($ev->id, 'ecwd_event_calendars', $this->sanitize_text($ev->calendars));
    //venue and venue data
    $location_info = $ev->get_location_info();
    if($location_info['complete_data'] === false) {

      delete_post_meta($ev->id, 'ecwd_event_venue');
      delete_post_meta($ev->id, 'ecwd_event_location');
      delete_post_meta($ev->id, 'ecwd_lat_long');
      delete_post_meta($ev->id, 'ecwd_event_show_map');
      delete_post_meta($ev->id, 'ecwd_map_zoom');

    } else {

      update_post_meta($ev->id, 'ecwd_event_venue', $this->sanitize_text($ev->venue['post']->ID));
      update_post_meta($ev->id, 'ecwd_event_location', $this->sanitize_text($location_info['location']));
      update_post_meta($ev->id, 'ecwd_lat_long', $this->sanitize_text($location_info['lat_long']));
      update_post_meta($ev->id, 'ecwd_event_show_map', $this->sanitize_text($location_info['show_map']));
      update_post_meta($ev->id, 'ecwd_map_zoom', $this->sanitize_text($location_info['zoom']));

    }

    update_post_meta($ev->id, 'ecwd_event_organizers', $this->sanitize_text($ev->organizers));
    update_post_meta($ev->id, 'ecwd_event_url', $this->sanitize_text($ev->event_url));
    update_post_meta($ev->id, 'ecwd_event_video', $this->sanitize_text($ev->video_url));

    foreach($ev->repeat as $meta_key => $value) {

      if($value !== null) {
        update_post_meta($ev->id, $meta_key, $this->sanitize_text($value));
      } else {
        delete_post_meta($ev->id, $meta_key);
      }

    }

  }

  public function sanitize_text($str){
    if(!is_array($str)) {
      return sanitize_text_field($str);
    } else {
      foreach($str as $key => $value) {
        $str[$key] = $this->sanitize_text($value);
      }
      return $str;
    }

  }


}