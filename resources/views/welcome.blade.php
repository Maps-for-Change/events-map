  <!doctype html>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta property="og:title" content="Maps for Change"/>
<meta property="og:description" content="Organize. Resist. Repeat"/>
<link href='//api.tiles.mapbox.com/mapbox.js/v2.1.9/mapbox.css' rel='stylesheet' />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" type="text/css" href="/css/events-map.css">
<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:100,200,400,500,600,700,800' />
<title>Maps for Change</title>

<!--[if lte IE 9]>
       <meta http-equiv="refresh" content="0; url=https://go.berniesanders.com/page/event/search_simple" />
     <![endif]-->
<body class='list-view initial-view'>
<section id='header'>
<div id="header" class=montserrat>

  <div class="main-title-area">
    <div style="margin-bottom: 4px;">
      <div id='spiel'>
        <img src="/images/logo.png" alt="" style="width: 50%">
      </div>
    </div>
  </div>
</div>
</section>
<section id='activity-area' class='clearfix'>
  <article id='events'>
    <div id='filters'>
      <div id='loading-icon' class=montserrat>Loading...</div>
      <h3 id='switch-link'>
        <a href='javascript: void(null)' onclick='window.mapManager.toMapView()' id='to-map-view'>Show Map</a>
        <a href='javascript: void(null)' onclick='window.mapManager.toListView()' id='to-list-view'>Show List</a>
      </h3>
      <h4 class='lato title'>
        <span id='screen-title'>Filters</span>
        <span id='mobile-title'>Maps for Change</span>
      </h4>
      <form id='filter-form'>
        <table>
          <tr>
            <td>
              <h5 class=montserrat>By Zipcode</h5>
              <input type='number' name='zipcode' maxlength='5' placeholder='ZIPCODE' onclick="this.select();" >
            </td>
            <td>
              <h5 class=montserrat>Distance</h5>
              <select name='distance'>
                <option value='5'>5mi</option>
                <option value='20'>20mi</option>
                <option value='50' selected='selected'>50mi</option>
                <option value='100'>100mi</option>
              </select>
            </td>
            <td>
              <h5 class=montserrat>Sort By</h5>
              <select name='sort'>
                <option value='time' selected='selected'>Time</option>
                <option value='distance'>Distance</option>
                <option value='attendance'>Attendance</option>
              </select>
              <input type='button' style='position: absolute; z-index: -1; opacity: 0;' id='hidden-button'/>
            </td>
          </tr>
        </table>
        <div id='filter-popup-area' class='montserrat'>
          <a href='javascript: void(null)' class='filter-button show-filter' onclick='$("#events").addClass("show-type-filter");'>
            Search by Type
          </a>
          <div id='filter-list-area'>
            <h5>Search by Type</h5>
            <div id='f-container'>
              <div id='filter-list-container'>
                <ul id='filter-list'></ul>
              </div>
              <div style='text-align: center; font-size: 11px; margin-top: 10px; color: lightgray;'>
              <a href='javascript: void(null)' id='show-all'
                 onclick='$("#filter-list").find("input[type=checkbox]").prop("checked", true).trigger("change");'>Show All</a> &bull;
              <a href='javascript: void(null)'
                 onclick='$("#filter-list").find("input[type=checkbox]").prop("checked", false).trigger("change")'>Hide All</a>
              </div>
            </div>
            <p align='right'>
              <a href='javascript: void(null)' class='filter-button'
                 onclick='$("#events").removeClass("show-type-filter");'>
                Hide Legend
              </a>
            </p>
          </div>
        </div>
      </form>
    </div>
    <div id='event-list-container'>
      <div id='hide-show-office' data-count="0">
        <a href='javascript: void(null)' class='contribute-big show-office' onclick='$("body").addClass("show-office")'>
          <span class='show-offices'>&#8882; Show Nearby Offices (<span id='campaign-off-count'></span>)</span>
        </a>
        <a href='javascript: void(null);' class='contribute-big hide-office' onclick='$("body").removeClass("show-office")'>
          <span class='hide-offices'>&#8883; Hide Offices</span>
        </a>
      </div>
      <ul id='event-list'><li class='mobile-only lato'>Please type in your <span style='font-weight: 400'>zipcode</span> to view nearby groups, meetings, and events.
      </li></ul>
      <footer>
        <div id='footer-area' >
          <!-- <h5>Friends of Bernie Sanders</h5>
          <h5>PO Box 391</h5>
          <h5>Burlington, VT 05402</h5>

          <div id='paid-for-bernie-box'>
            Paid for By Friends of Bernie Sanders
          </div>
          <div id='footer-billionaire' style="margin-bottom: 30px;">
            <svg width="200" height="40">
                <image xlink:href="//d2bq2yf31lju3q.cloudfront.net/img/billionaires.svg" width="200" height="40"
                  x="0"
                />
            </svg>
          </div> -->

          <sub>&copy; Maps for Change</sub>
        </div>

      </footer>
    </div>
  </article>
  <article id='map'>
    <div id='map-container'></div>
  </article>
</section>
<section id='campaign-offices'>
  <div class='viewport'>
    <h3 class='title'>Nearby Campaign Offices</h3>
    <a class='close-button lato' href='javascript: void(null);' onclick='$("body").removeClass("show-office")'>x</a>
    <div class='container'>
      <ul id='campaign-office-list'></ul>
    </div>
  </div>
</section>

<script src="https://d2zfgjd0dxweyq.cloudfront.net/js/jquery.gz"></script>
<script src='https://d2zfgjd0dxweyq.cloudfront.net/js/d3.gz' type='text/javascript'></script>
<script id='zipcodes-datadump' type='text/plain'></script>
<script src='https://d2zfgjd0dxweyq.cloudfront.net/js/deparam.min.gz'></script>
<script src='https://d2zfgjd0dxweyq.cloudfront.net/js/mapbox.gz'></script>
<!-- <script src='/js/leaflet-bouncer.js'></script> -->
<script src='https://d2zfgjd0dxweyq.cloudfront.net/js/moment.min.js'></script>
<script src='https://d2zfgjd0dxweyq.cloudfront.net/js/js-cookie.js'></script>
<script src='/js/MapManager.js'></script>
<script type='text/javascript'>
window.eventTypeFilters = [
  // {
  //   name: 'Campaign Office',
  //   id: 'campaign-office',
  //   onItem: "<img style='width: 14px; height: 14px;' src='//d2bq2yf31lju3q.cloudfront.net/img/icon/star.png' />",
  //   offItem: "<img style='width: 14px; height: 14px;' src='//d2bq2yf31lju3q.cloudfront.net/img/icon/star-gray.png' />"
  // },
  {
    name: 'Event',
    id: 'event'
  },
  {
    name: 'Group',
    id: 'group'
  },
  {
    name: 'Group Meeting',
    id: 'group-meeting'
  }
];
</script>
<script type='text/javascript'>
(function($, d3) {
var date = new Date();
$("#loading-icon").show();
$.ajax({
  url: '/events',
  dataType: 'json',
  cache: true, // otherwise will get fresh copy every page load
  success:  function(data) {
    window.EVENT_DATA = data;
        d3.csv('//d1y0otadi3knf6.cloudfront.net/d/us_postal_codes.gz',
         function(zipcodes) {
           $("#loading-icon").hide();
          //Clean data
          window.EVENT_DATA.forEach(function(d) {
            d.filters = [];
            //Set filter info
            switch(d.event_type) {
              case "Facebook Event": d.filters.push('facebook-event'); break;
              case "Event": d.filters.push('event'); break;
              case "Group Meeting": d.filters.push('group-meeting'); break;
              case "Group": d.filters.push("group"); break;
              default: d.filters.push('other'); break;
            }

            d.is_official = d.is_official == "1";
            if (d.is_official) { d.filters.push("official-event"); }
          });

          var oldDate = new Date();

          /* Extract default lat lon */
          var m = /.*\?c=(.+?),(.+?),(\d+)z#?.*/g.exec(window.location.href)
          if (m && m[1] && m[2] && m[3]) {
            var defaultCoord = {
              center: [parseFloat(m[1]), parseFloat(m[2])],
              zoom: parseInt(m[3])
            };
            window.mapManager = MapManager(window.EVENT_DATA, campaignOffices, zipcodes, { defaultCoord: defaultCoord });
            var params = $.deparam
            window.mapManager.filterByCoords(defaultCoord.center, 50, params.sort, params.f);
          } else {
            window.mapManager = MapManager(window.EVENT_DATA, null, zipcodes);
          }

          if($("input[name='zipcode']").val() == '' && Cookies.get('map.bernie.zipcode') && window.location.hash == '') {
            $("input[name='zipcode']").val(Cookies.get('map.bernie.zipcode'));
            window.location.hash = $("#filter-form").serialize();
          } else {
            $(window).trigger("hashchange");
          }
        });
      }
});


 /** initial loading before activating listeners...
  */

 var params = $.deparam(window.location.hash.substring(1));
  if (params.zipcode) {
    $("input[name='zipcode']").val(params.zipcode);
  }

  if (params.distance) { $("select[name='distance']").val(params.distance);}
  if (params.sort) { $("select[name='sort']").val(params.sort);}

/* Prepare filters */
$("#filter-list").append(
  window.eventTypeFilters.map(function(d) {
    return $("<li />")
              .append(
                $("<input type='checkbox' class='filter-type' />")
                    .attr('name', 'f[]')
                    .attr("value", d.id)
                    .attr("id", d.id)
                    .prop("checked", !params.f ? true : $.inArray(d.id, params.f) >= 0)
              )
              .append($("<label />").attr('for', d.id).append($("<span />").addClass('filter-on')
                        .append(d.onItem ? d.onItem : $("<span>").addClass('circle-button default-on')))
              .append($("<span />").addClass('filter-off')
                        .append(d.offItem ? d.offItem : $("<span>").addClass('circle-button default-off')))
                        .append($("<span>").text(d.name)));
  })
);
/***
 *  define events
 */
 //only numbers
 $("input[name='zipcode']").on('keyup keydown', function(e) {
  if (e.type == 'keydown' && (e.keyCode < 48 || e.keyCode > 57)
      && e.keyCode != 8 && !(e.keyCode >= 37 || e.keyCode <= 40)) {
    return false;
  }

  if (e.type == 'keyup' && $(this).val().length == 5) {
    if (! (e.keyCode >= 37 && e.keyCode <= 40) ) {
      $(this).closest("form#filter-form").submit();
      $("#hidden-button").focus();
    }
  }
 });

 /***
  *  onchange of select
  */
  $("select[name='distance'],select[name='sort']").on('change', function(e) {
    $(this).closest("form#filter-form").submit();
  });

  /**
  * On filter type change
  */
  $(".filter-type").on('change', function(e) {
    $(this).closest("form#filter-form").submit();
  })

 //On submit
 $("form#filter-form").on('submit', function(e) {
  var serial = $(this).serialize();
  window.location.hash = serial;
  e.preventDefault();
  return false;
 });

 $(window).on('hashchange', function(e) {

  var hash = window.location.hash;
  if (hash.length == 0 || hash.substring(1) == 0) { $("#loading-icon").hide(); return false; }

  var params = $.deparam(hash.substring(1));

  //Custom feature for specific default lat/lon
  //lat=40.7415479&lon=-73.8239609&zoom=17

  setTimeout(function() {
    $("#loading-icon").show();

    if ( window.mapManager._options && window.mapManager._options.defaultCoord && params.zipcode.length != 5) {
      window.mapManager.filterByType(params.f);
      window.mapManager.filterByCoords(window.mapManager._options.defaultCoord.center, params.distance, params.sort, params.f);
    } else {
      window.mapManager.filterByType(params.f);
      window.mapManager.filter(params.zipcode, params.distance, params.sort, params.f);
    }
    $("#loading-icon").hide();

    // var $info = window.votingInfoManager.getInfo(window.mapManager._zipcodes[params.zipcode].state);
    // $(".registration-msg").remove();
    // if ($info) {
    //   $info.prependTo("#event-list-container");
    // }

  }, 10);
  // $("#loading-icon").hide();
  if (params.zipcode.length == 5 && $("body").hasClass("initial-view")) {
    $("#events").removeClass("show-type-filter");
    $("body").removeClass("initial-view");
  }
 });

  var pre = $.deparam(window.location.hash.substring(1));
  if ($("body").hasClass("initial-view")) {
    if ($(window).width() >= 600 && (!pre.zipcode || pre && pre.zipcode.length != 5)) {
      $("#events").addClass("show-type-filter");
    }
  }


})(jQuery, d3);

</script>

<!-- SOCIAL -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58354050-1', 'auto');
  ga('send', 'pageview');
  </script>
  <script>
  // window.fbAsyncInit = function() {
  //   FB.init({
  //     appId      : '1747464662152148',
  //     xfbml      : true,
  //     version    : 'v2.5'
  //   });
  // };

  // (function(d, s, id){
  //    var js, fjs = d.getElementsByTagName(s)[0];
  //    if (d.getElementById(id)) {return;}
  //    js = d.createElement(s); js.id = id;
  //    js.src = "//connect.facebook.net/en_US/sdk.js";
  //    fjs.parentNode.insertBefore(js, fjs);
  //  }(document, 'script', 'facebook-jssdk'));
</script>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</body>
<script>
    function fbShare(url, title, descr, image, winWidth, winHeight) {
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }
</script>