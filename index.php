<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PHP caching example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MemCachier PHP Example">
    <meta name="author" content="MemCachier">

    <link href="/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <style type="text/css">
      /* Sticky footer styles
      -------------------------------------------------- */
      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }

      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */
      .container {
        width: auto;
        max-width: 680px;
      }
      .container .credit {
        margin: 20px 0;
      }
    </style>
    <link href="/bootstrap-responsive.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/html5shiv.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="/favicon.ico">
  </head>

  <body>
    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>
            PHP caching example
          </h1>
        </div>
        <p class="lead">For any number N, we'll find the largest prime number 
          less than or equal to N.  Because our implementation is incredibly basic, we 
          don't accept N greater than 10,000.  When you submit the form, we'll check the 
          cache to see if we've calculated the largest prime for N. If we get a hit, 
          we'll return the results from the cache.  If not, we'll do the calculation.</p>
        <form action="">
          <input type="text" id="n" />
          <input type="button" value="Submit" data-compute="true" />
        </form>
        <p id="prime" class="lead text-info"></p>
      </div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="muted credit">Example by
          <a href="http://www.memcachier.com">
            <img class="brand" src="/memcachier-small.png" alt="MemCachier"
              title="MemCachier" style="padding-left:8px;padding-right:3px;padding-bottom:3px;"/>
            MemCachier
          </a>
        </p>
      </div>
    </div>

    <script src="/jquery-1.7.2.js"></script>
    <script src="/main.js"></script>
    <script src="/bootstrap.js"></script>
  </body>
</html>
