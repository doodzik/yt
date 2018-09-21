<?php
final class YouTube {
    private $youtube;

    public static function Instance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new YouTube();
        }
        return $inst;
    }

    public static function playlist_link($id) {
        $website = getenv('WEBSITE');
        return "$website/watch?list=$id";
      }
    
    public static function video_link($id) {
      $website = getenv('WEBSITE');
      return "$website/watch?v=$id";
    }

    public static function video_url($id, $loop = false) {
      if ($loop) {
        return "https://www.youtube.com/embed/$id?modestbranding=1&amp;rel=0&amp;iv_load_policy=3&amp;loop=1&amp;playlist=$id";
      } else {
        return "https://www.youtube.com/embed/$id?modestbranding=1&amp;rel=0&amp;iv_load_policy=3";
      }
    }

    public static function playlist_url($id, $video_id = '') {
      if (strlen($video_id) == 0) {
        return "https://www.youtube.com/embed/videoseries?list=$id&amp;modestbranding=1&amp;rel=0&amp;iv_load_policy=3";
      } else {
        return "https://www.youtube.com/embed/videoseries?list=$id&amp;modestbranding=1&amp;rel=0&amp;v=$video_id&amp;iv_load_policy=3";
      }
    }

    private function __construct(){
      $DEVELOPER_KEY = getenv('GOOGLE_DEV_KEY');
      $google_client = new Google_Client();
      $google_client->setDeveloperKey($DEVELOPER_KEY);
      $this->youtube = new Google_Service_YouTube($google_client);
    }

    function videosList($part, $params) {
        $params = array_filter($params);
        return $this->youtube->videos->listVideos($part, $params);
    }

    function playlistsList($part, $params) {
        $params = array_filter($params);
        return $this->youtube->playlists->listPlaylists($part, $params);
    }

    function titleForPlaylist($id) {
      $response = $this->playlistsList('snippet', array('id' => $id));
      return $response['items'][0]['snippet']['title'];
    }

    function titleForVideo($id) {
      $response = $this->videosList('snippet', array('id' => $id));
      return $response['items'][0]['snippet']['title'];
    }

    function query($query) {
        $query_result = array('videos' => array(), 'playlists' => array(), 'error' => '');
        try {
          $searchResponse = $this->youtube->search->listSearch('id,snippet', array(
            'q' => $query,
            'maxResults' => 10,
          ));

          foreach ($searchResponse['items'] as $searchResult) {
            $title = $searchResult['snippet']['title'];
            $thumbnail = $searchResult['snippet']['thumbnails']['medium']['url'];
            if ($searchResult['id']['kind'] == 'youtube#video') {
              $id = $searchResult['id']['videoId'];
              array_push($query_result['videos'], array(
                'video_url' => YouTube::video_link($id),
                'thumbnail' => $thumbnail,
                'title' => $title));
            } else if ($searchResult['id']['kind'] == 'youtube#playlist') {
              $id = $searchResult['id']['playlistId'];
              array_push($query_result['playlists'], array(
                'video_url' => YouTube::playlist_link($id),
                'thumbnail' => $thumbnail,
                'title' => $title));
            }
        }
      } catch (Google_Service_Exception $e) {
        $query_result['error'] = sprintf('<p>A service error occurred: <code>%s</code></p>',
          htmlspecialchars($e->getMessage()));
      } catch (Google_Exception $e) {
        $query_result['error'] = sprintf('<p>An client error occurred: <code>%s</code></p>',
          htmlspecialchars($e->getMessage()));
      }
      return $query_result;
    }
}
?>
