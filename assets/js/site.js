$(function () {
      $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

      if (!screenfull.enabled) {
        return false;
      }

      

      $('#toggle').click(function () {
        screenfull.toggle($('#container')[0]);
      });
      

      
    });
    $(document).ready(function() {
      
    })
    
    function mainS(){
      $('#main-status').html('<span class="alert alert-success"><i class="fa fa-check"></i> Successful</span>');
      $('#main-status').fadeToggle();
      $('#main-status').delay(1000).fadeToggle();
    }
    function mainE(){
      $('#main-status').html('<span class="alert alert-danger"><i class="fa fa-times"></i> Unsuccessful</span>');
      $('#main-status').fadeToggle();
      $('#main-status').delay(1000).fadeToggle();
    }
    function start() {
      $('#wait').fadeIn()
    }
    function end() {
      $('#wait').fadeOut()
    }
    function error() {
      end();
      $('#error').fadeIn()
      $('#error').delay(1500).fadeOut()
    }
    function success() {
      end();
      $('#success').fadeIn()
      $('#success').delay(1500).fadeOut()
    }
    function validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }// call this from the developer console and you can control both instances
var calendars = {};

$(document).ready( function() {

  // assuming you've got the appropriate language files,
  // clndr will respect whatever moment's language is set to.
  // moment.lang('ru');

  // here's some magic to make sure the dates are happening this month.
  var thisMonth = moment().format('YYYY-MM');

  var eventArray = [
    { startDate: thisMonth + '-10', endDate: thisMonth + '-14', title: 'Multi-Day Event' },
    { startDate: thisMonth + '-21', endDate: thisMonth + '-23', title: 'Another Multi-Day Event' }
  ];

  // the order of the click handlers is predictable.
  // direct click action callbacks come first: click, nextMonth, previousMonth, nextYear, previousYear, or today.
  // then onMonthChange (if the month changed).
  // finally onYearChange (if the year changed).

  calendars.clndr1 = $('.cal1').clndr({
    events: eventArray,
    // constraints: {
    //   startDate: '2013-11-01',
    //   endDate: '2013-11-15'
    // },
    clickEvents: {
      click: function(target) {
        console.log(target);
        if($(target.element).hasClass('inactive')) {
          console.log('not a valid datepicker date.');
        } else {
          console.log('VALID datepicker date.');
        }
      },
      nextMonth: function() {
        console.log('next month.');
      },
      previousMonth: function() {
        console.log('previous month.');
      },
      onMonthChange: function() {
        console.log('month changed.');
      },
      nextYear: function() {
        console.log('next year.');
      },
      previousYear: function() {
        console.log('previous year.');
      },
      onYearChange: function() {
        console.log('year changed.');
      }
    },
    multiDayEvents: {
      startDate: 'startDate',
      endDate: 'endDate'
    },
    showAdjacentMonths: true,
    adjacentDaysChangeMonth: false
  });

  // calendars.clndr2 = $('.cal2').clndr({
  //   template: $('#template-calendar').html(),
  //   events: eventArray,
  //   startWithMonth: moment().add('month', 1),
  //   clickEvents: {
  //     click: function(target) {
  //       console.log(target);
  //     }
  //   }
  // });

  // bind both clndrs to the left and right arrow keys
  $(document).keydown( function(e) {
    if(e.keyCode == 37) {
      // left arrow
      calendars.clndr1.back();
      calendars.clndr2.back();
    }
    if(e.keyCode == 39) {
      // right arrow
      calendars.clndr1.forward();
      calendars.clndr2.forward();
    }
  });

});