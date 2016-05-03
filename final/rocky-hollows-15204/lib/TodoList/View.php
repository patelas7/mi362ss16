<?php


namespace TodoList;

class View
{
    const ERROR_MSG = 'error';

    /**
     * Set the page title
     * @param $title New page title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Create the HTML for the contents of the head tag
     * @return string HTML for the page head
     */
    public function head() {
        return <<<HTML
<meta charset="utf-8">
<title>$this->title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
HTML;
    }

    /**
     * Create the HTML for the page header
     * @return string HTML for the standard page header
     */
    public function header() {
        $html = <<<HTML
<nav>
    <ul class="left">
        <li><a href="post/logout.php">Home</a></li>
    </ul>
HTML;

        if(count($this->links) > 0) {
            $html .= '<ul class="right">';
            foreach($this->links as $link) {
                $html .= '<li><a href="' .
                    $link['href'] . '">' .
                    $link['text'] . '</a></li>';
            }
            $html .= '</ul>';
        }

        $additional = $this->headerAdditional();

        $html .= <<<HTML
</nav>
<header class="main">
    <h1>$this->title</h1>
    $additional
</header>
HTML;
        return $html;
    }

    /**
     * Add a link that will appear on the nav bar
     * @param $href What to link to
     * @param $text
     */
    public function addLink($href, $text) {
        $this->links[] = array("href" => $href, "text" => $text);
    }

    /**
     * Override in derived class to add content to the header.
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return '';
    }

    /**
     * Set error message
     * @param array $get $_GET
     * @param array $session $_SESSION
     */
    public function setMsg(array $get, array &$session){
        if(isset($get['e'])) {
            if(isset($session[self::ERROR_MSG])){
                $this->msg = $session[self::ERROR_MSG];
                unset($session[self::ERROR_MSG]);
            }
        }
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }


    private $msg = '';	///< Message to display
    private $title = "";	///< The page title
    private $links = array();	///< Links to add to the nav bar

}