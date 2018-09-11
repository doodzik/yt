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

    public static function video_url($id) {
      return "https://www.youtube.com/embed/$id?modestbranding=1&amp;rel=0";
    }

    public static function playlist_url($id) {
      return "https://www.youtube.com/embed/videoseries?list=$id&amp;modestbranding=1&amp;rel=0";
    }

    private function __construct(){
      $DEVELOPER_KEY = getenv('GOOGLE_DEV_KEY');
      $google_client = new Google_Client();
      $google_client->setDeveloperKey($DEVELOPER_KEY);
      $this->youtube = new Google_Service_YouTube($google_client);
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
                'video_url' => YouTube::video_url($id),
                'thumbnail' => $thumbnail,
                'title' => $title));
            } else if ($searchResult['id']['kind'] == 'youtube#playlist') {
              $id = $searchResult['id']['playlistId'];
              array_push($query_result['playlists'], array(
                'video_url' => YouTube::playlist_url($id),
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
