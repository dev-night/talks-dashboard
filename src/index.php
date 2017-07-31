<?php
require_once("vendor/autoload.php");
require_once("github-client.php");

$issues = getIssues(json_decode(file_get_contents("config.json")));
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.0/css/bulma.min.css">
<link rel="stylesheet" href="css/main.css">

<!-- Include the library in the page -->
<script src="https://unpkg.com/vue/dist/vue.js"></script>

<!-- App -->
<div class="container">
    <h1>Talks</h1>
    <div id="app">
        <div v-for="talk of talks" class="box">
            <article class="media">

                <div class="media-content">
                  <div class="content">
                    <p>
                      <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
                      <br>
                      <a v-bind:href="talk.node.url">{{ talk.node.title }}</a>
                    </p>
                  </div>
                  <nav class="level is-mobile">
                    <div class="level-left">
                      <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-reply"></i></span>
                      </a>
                      <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                      </a>
                      <a class="level-item">
                        <span class="icon is-small"><i class="fa fa-heart"></i></span>
                      </a>
                    </div>
                  </nav>
                </div>
                <div class="media-right" v-for="assigne of talk.node.assignees">
                  <figure class="image is-64x64" v-if="typeof assigne.node !== undefined">

                    <img v-bind:src="assigne.node.avatarUrl" alt="Image">
                  </figure>
                </div>
            </article>
          <!-- <div class="author">By {{ issue.author.name }}</div> -->
        </div>
     </div>
</div>

<script>

function get (object, prop) {
  if (typeof object[prop] !== 'undefined') {
    return object[prop]
  }
  return ''
}

// New VueJS instance
const app = new Vue({
    // CSS selector of the root DOM element
    el: '#app',
    data: {
        talks: <?php echo json_encode($issues) ?>,
        loading: 0
    }
})
</script>
</html>