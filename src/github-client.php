<?php
/*
 * This script gets the issue data from the Github API.
 */



/**
 * Gets all issue data.
 *
 * @param $config
 * @return mixed
 */
function getIssues($config) {
    //GRAPHQL request
    $request = <<<'JSON'
    query{
       repository(owner:"dev-night", name:"talks") {
        issues(last:20, states:OPEN) {
          edges {
            node {
              title
              url
              assignees(first:100) {
                edges {
                  node {
                    avatarUrl
                    name
                    email
                    url
                    login
                  }
                }
              }
              reactions(first:100) {
                edges {
                  node {
                    content
                  }
                }
              }
              labels(first:10) {
                edges {
                  node {
                    name
                    color
                  }
                }
              }
            }
          }
        }
      }
    }
JSON;
    $request = queryURL($config->url, $config->token, $request);

    return json_decode($request, true)['data']['repository']['issues']['edges'];
}

/**
 * Querys a $url and returns the result.
 *
 * @param $url
 * @param $token
 * @param $query
 * @return mixed
 */
function queryURL($url, $token, $query) {
    $json = json_encode(['query' => $query, 'variables' => '']);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'User-Agent: PHP Script',
            'Content-Type: application/json;charset=utf-8',
            'Authorization: bearer '.$token
        )
    );

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
