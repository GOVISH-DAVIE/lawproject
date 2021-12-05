@extends('layouts.app')

@section('content')
 <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev" onclick='tomoth()'>
          <i class="calendar-icon ic-arrow-line-left" data-action="move-prev">day</i>
        </button>
  <div id="menu">
      <span id="menu-navi">
        <button id='today'type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev" onclick='moveToNextOrPrevRange(-1)'>
          <i class="calendar-icon ic-arrow-line-left" data-action="move-prev" >prev</i>
        </button>
        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next"  onclick='moveToNextOrPrevRange(1)' >
          <i class="calendar-icon ic-arrow-line-right" data-action="move-next"> next </i>
        </button>
      </span>
      <span id="renderRange" class="render-range"></span>
    </div>

    <div id="calendar"></div>
<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />

<!-- If you use the default popups, use this. -->
<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css" />
<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css" />
<script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
<script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
<script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
<script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>

<script>

 var templates = {
    popupIsAllDay: function() {
      return 'All Day';
    },
    popupStateFree: function() {
      return 'Free';
    },
    popupStateBusy: function() {
      return 'Busy';
    },
    titlePlaceholder: function() {
      return 'Subject';
    },
    locationPlaceholder: function() {
      return 'Location';
    },
    startDatePlaceholder: function() {
      return 'Start date';
    },
    endDatePlaceholder: function() {
      return 'End date';
    },
    popupSave: function() {
      return 'Save';
    },
    popupUpdate: function() {
      return 'Update';
    },
    popupDetailDate: function(isAllDay, start, end) {
      var isSameDate = moment(start).isSame(end);
      var endFormat = (isSameDate ? '' : 'YYYY.MM.DD ') + 'hh:mm a';

      if (isAllDay) {
        return moment(start).format('YYYY.MM.DD') + (isSameDate ? '' : ' - ' + moment(end).format('YYYY.MM.DD'));
      }

      return (moment(start).format('YYYY.MM.DD hh:mm a') + ' - ' + moment(end).format(endFormat));
    },
    popupDetailLocation: function(schedule) {
      return 'Location : ' + schedule.location;
    },
    popupDetailUser: function(schedule) {
      return 'User : ' + (schedule.attendees || []).join(', ');
    },
    popupDetailState: function(schedule) {
      return 'State : ' + schedule.state || 'Busy';
    },
    popupDetailRepeat: function(schedule) {
      return 'Repeat : ' + schedule.recurrenceRule;
    },
    popupDetailBody: function(schedule) {
      return 'Body : ' + schedule.body;
    },
    popupEdit: function() {
      return 'Edit';
    },
    popupDelete: function() {
      return 'Delete';
    }
  };

  var cal = new tui.Calendar('#calendar', {
    defaultView: 'month',
    template: templates,
    theme:{
    'common.border': '1px solid #ffbb3b',
    'common.backgroundColor': '#ffbb3b0f',
    'common.holiday.color': '#f54f3d',
    'common.saturday.color': '#3162ea',
    'common.dayname.color': '#333'
  },
    useCreationPopup: true,
    useDetailPopup: true
  });
  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];    
const tomoth =()=> cal.changeView('day', true);
function moveToNextOrPrevRange(val) {
if (val === -1) {
cal.prev();
} else if (val === 1) {
cal.next();
}
document.getElementById('today').innerHTML =months[(new Date(cal.getDate(   )._date)).getMonth()  ]

}
</script>
@endsection