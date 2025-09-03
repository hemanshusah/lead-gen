$(document).ready(function () {

  //set the dom that will hold the calendar
  var calendar_wrapper = document.getElementById('calendar_wrapper');

  //initiate the calendar
  NX.calendar = new FullCalendar.Calendar(calendar_wrapper, {

    //general settings
    initialDate: NX.calendar_data.today,
    initialView: 'dayGridMonth',
    themeSystem: 'bootstrap5',
    expandRows: true,
    slotMinTime: '00:00',
    slotMaxTime: '23:00',
    firstDay: NX.calendar_start_day,
    locale: NXLANG.calender_lang,
    /* ------------------------------------------------------------------------------------
     * [custom buttonsn]
     *   - action when the 'settings button has been clicked (show side panel)
     *   - action when the 'add' button has been clicked
     * of team members
     * -----------------------------------------------------------------------------------*/
    customButtons: {
      //settings button
      custom_button_settings: {
        text: '',
        click: function () {
          //load side panel
          var $panel = $("#sidepanel-calender-settings");
          var $overlay = $(".page-wrapper-overlay");
          $panel.toggleClass("shw-rside");
          $overlay.toggle();
          if ($overlay.is(":visible")) {
            $('body').addClass('overflow-hidden');
          }
        }
      },
      //add new event button
      custom_button_add_event: {
        text: '',
      }
    },

    //render buttons
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek,custom_button_settings,custom_button_add_event'
    },
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    selectable: true,
    nowIndicator: true,
    dayMaxEvents: true, // allow "more" link when too many events

    /* ------------------------------------------------------------------------------------
     * [set the events]
     *   - set all the calender events, using the payload from the backend
     * -----------------------------------------------------------------------------------*/
    events: NX.calendar_events,


    /* ------------------------------------------------------------------------------------
     * [format how time is displayed]
     * -----------------------------------------------------------------------------------*/
    eventTimeFormat: {
      hour: '2-digit',
      minute: '2-digit',
      meridiem: false
    },

    /* ------------------------------------------------------------------------------------
     * [date clicked]
     * A date has been clicked on the calendar
     *   - generate a new URL for the 'add' button
     *   - trigger a click on the button to load the modal
     * -----------------------------------------------------------------------------------*/
    dateClick: function (info) {

      //get the date that was clicked and update the 'add' buttons url
      var current_date = info.dateStr;
      var current_url = $('#calendar-add-button').attr('data-url-backup');
      var new_url = current_url + '?event_date=' + current_date;

      //update the data attribute of the 'add' button, with the new url (that appends the date click)
      $('#calendar-add-button').attr('data-url', new_url);

      //click the button
      $('#calendar-add-button').click();
    },



    /* ------------------------------------------------------------------------------------
     * [event clicked]
     * An event has been clicked on the calendar
     *   - generate a new URL for the virtual 'show' button
     *   - trigger a click on the button to load the modal
     *   - example url: https://domain.com/calendar/4?type=project&event_id=473hjhfy3787
     * 
     * -----------------------------------------------------------------------------------*/
    eventClick: function (info) {

      //create a new url to load this event using the virtual 'show' button
      var event_id = info.event.id;
      var resource_type = info.event.extendedProps.resource_type;
      var resource_id = info.event.extendedProps.resource_id;
      var current_url = $('#calendar-event-trigger').attr('data-url-backup');
      var new_url = current_url + event_id + '?resource_type=' + resource_type + '&resource_id=' + resource_id;

      //update the url on the virtual 'show' button
      $('#calendar-event-trigger').attr('data-url', new_url);

      //trigger a click on the virtual 'show' button
      $('#calendar-event-trigger').click();

    }

  });

  /* ------------------------------------------------------------------------------------
   * [render the calendar]
   * -----------------------------------------------------------------------------------*/
  NX.calendar.render();


  /* ------------------------------------------------------------------------------------
   * [custom button]
   * Add an additional button on the actions pane;
   *   - settings button  
   * -----------------------------------------------------------------------------------*/
  setTimeout(function () {
    var $button = $('.fc-custom_button_settings-button');
    if ($button.length) {
      $button.attr({
        'data-toggle': 'tooltip',
        'title': NXLANG.calender_settings,
        'data-target': 'sidepanel-calender-settings'
      }).html('<i class="sl-icon-settings"></i>');
    }
  }, 0);


  /* ------------------------------------------------------------------------------------
   * [custom button]
   * Add an additional button on the actions panel
   *   - add new event button (the red button)
   * -----------------------------------------------------------------------------------*/
  setTimeout(function () {
    var $button = $('.fc-custom_button_add_event-button');
    if ($button.length) {
      $button.attr({
        'id': 'calendar-add-button',
        'data-toggle': 'modal',
        'title': 'Calender Settings',
        'data-toggle': 'modal',
        'data-target': '#commonModal',
        'data-loading-target': 'commonModalBody',
        'data-modal-title': NXLANG.calender_add_event,
        'data-action-url': NX.calendar_action_url,
        'data-action-method': 'POST',
        'data-action-ajax-class': 'ajax-request',
        'data-modal-size': 'modal-lg',
        'data-action-ajax-loading-target': 'commonModalBody',
        'data-url-backup': NX.calendar_add_url,
        'data-url': NX.calendar_add_url,
      }).html('<i class="ti-plus"></i>');
      $button.addClass('edit-add-modal-button');
      $button.addClass('js-ajax-ux-request');
      $button.addClass('reset-target-modal-form');
    }
  }, 0);


  /* ------------------------------------------------------------------------------------
   * [all-day button]
   * All day button has been clicked
   *   - show or hide the start and end times
   * -----------------------------------------------------------------------------------*/
  $(document).on('click', '#calendar_event_all_day', function () {
    //if the button is checked
    if ($(this).is(':checked')) {
      //show elements with class start_time and end_time
      $('.calendar_event_start_time, .calendar_event_end_time').hide();
    } else {
      //else hide these elements
      $('.calendar_event_start_time, .calendar_event_end_time').show();
    }
  });


  /* ------------------------------------------------------------------------------------
   * [update add button]
   * On mouse over, update the data-url on the add button. This is to reset the url
   * that was added when a date was clicked on the calendar
   * -----------------------------------------------------------------------------------*/
  $(document).on('mouseover', '#calendar-add-button', function () {
    var backupUrl = $(this).attr("data-url-backup");
    $(this).attr("data-url", backupUrl);
  });




});


/* ------------------------------------------------------------------------------------
 * [sharing button]
 * If the sharing option selected in 'selected team members', show the select list
 * of team members
 * -----------------------------------------------------------------------------------*/
$(document).ready(function () {
  $(document).on('click', '.share-with', function () {
    $('.share-with').not(this).prop('checked', false);
    if (this.id === 'share_with_team_members') {
      $('#share-with-users-container').show();
    } else {
      $('#share-with-users-container').hide();
    }
  });
});


/* ------------------------------------------------------------------------------------
 * [ajax js actions]
 * the modal for adding a new event has loaded
 *   - show or hide the start and end time options
 * -----------------------------------------------------------------------------------*/
function NXCalendarCreate() {
  //initial calendar state
  if ($('#calendar_event_all_day').is(':checked')) {
    $('.calendar_event_start_time, .calendar_event_end_time').hide();
  } else {
    $('.calendar_event_start_time, .calendar_event_end_time').show();
  }
}


/* ------------------------------------------------------------------------------------
 * [edit event button]
 * -----------------------------------------------------------------------------------*/
$(document).ready(function () {
  $(document).on('click', '#calendar-edit-event-button', function () {
    $('#calendar-show-container').hide();
    $('#calendar-edit-container').show();
  });
});


/* ------------------------------------------------------------------------------------
 * [cancel editing event button]
 * -----------------------------------------------------------------------------------*/
$(document).ready(function () {
  $(document).on('click', '#calendar-cancel-edit-event-button', function () {
    $('#calendar-edit-container').hide();
    $('#calendar-show-container').show();
  });
});