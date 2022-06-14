var events = [
    {
        title: '0.25$',
        start: '2020-03-26'
    },
    {
        title: '5$',
        start: '2020-03-26'
    },
    {
        title: '0.25$',
        start: '2020-03-27'
    },
];
$('#calendar').fullCalendar({
    events: events,
    height: "auto",
    contentHeight: "auto"
});