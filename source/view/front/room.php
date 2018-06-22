<?php include 'home.php' ?>
<?php startblock('title') ?>
    <title>Room Lab</title>
<?php endblock() ?>
<?php startblock('content') ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 text-center">
                <label for="roomlist">List Lab</label>
                <div id="roomlist" class="list-group">
                    <?php 
                        foreach($data as $lab) {
                            $datalab = json_encode($lab);
                            echo "<a href='javascript:void(0)' onclick='changeLab($datalab)' class='list-group-item'>$lab->name</a>";
                        };
                    ?>
                </div>
            </div>
            <div class="col-md-10">
                <p class="text-center"><label for="schedule">Schedule</label><p>
                <div id="schedule" class="calltoshow">
                    <div class="header">
                    </div>
                    <div class="body">
                        <div style="float:left; width: 160px;">
                            <div id="nav"></div>
                            <div id="listSchedule"></div>
                        </div>
                        <div style="margin-left: 160px;">
                            <div id="dp"></div>
                        </div>
                    </div>
                    <!-- <div class="footer">
                        <button class="btn btn-default" type="button" onclick="requestSchedule()">save</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
<?php endblock()?>
<?php startblock('script') ?>
    <script src="public/assets/js/daypilot-all.min.js"></script>
    <script>
        var checkedLab = null;
        var begin_at = getSunday(new Date());
        var end_at  = getSatuday(new Date());
        function getSunday(d) {
            d = new Date(d);
            var day = d.getDay(),
                diff = d.getDate() - day;
            var Sunday = new Date(d.setDate(diff));
            var curr_date = Sunday.getDate();
            var curr_month = Sunday.getMonth() + 1; 
            var curr_year = Sunday.getFullYear();
            return curr_year+'-'+curr_month+'-'+curr_date;
        }
        
        function getSatuday(d) {
            d = new Date(d);
            var day = d.getDay(),
            diff = d.getDate() - day + 6; // adjust when day is sunday
            var Satuday = new Date(d.setDate(diff));
            var curr_date = Satuday.getDate();
            var curr_month = Satuday.getMonth() + 1; 
            var curr_year = Satuday.getFullYear();
            return curr_year+'-'+curr_month+'-'+curr_date;
        }

        var eventData = [];
        var dp = new DayPilot.Calendar("dp");
            dp.startDate = new Date();
            dp.viewType = "Week";
            dp.eventDoubleClickHandling = "Enabled";
            dp.eventDeleteHandling = "Update";
            // dp.headerDateFormat = "DDDD";
            dp.init();
        var nav = new DayPilot.Navigator("nav");
            nav.showMonths = 1;
            nav.selectMode = "week";
            nav.onTimeRangeSelected = function(args) {
                begin_at = args.start.value;
                end_at = args.end.value;
                dp.startDate = args.day;
                dp.update();
                loadSchedule();
                // loadEvents();
            };
            nav.init();
        // event creating
        dp.onTimeRangeSelected = function (args) {
            if ( User == ''){
                alert('Vui long dang nhap');
                return;
            }
            var name = prompt("New event name:", "Event");
            if (!name) return;
            var e = new DayPilot.Event({
                start: args.start,
                end: args.end,
                id: DayPilot.guid(),
                text: name
            });
            dp.events.add(e);
            pushEventList(e);
            dp.clearSelection();
        };

        dp.onEventClick = function(args) {
            if ( User == ''){
                alert('Vui long dang nhap');
                return;
            }
        };
        
        dp.onEventClick = function(args) {
            if ( User == ''){
                alert('Vui long dang nhap');
                return;
            }
        };
        
        dp.onDoubleClick = function(args) {
            if ( User == ''){
                alert('Vui long dang nhap');
                return;
            }
            console.log(args);
        };
        
        dp.onEventDelete = function(args) {
            if (!confirm("Do you really want to delete this event?")) {
                args.preventDefault();
            } else {
                var event = args.e.data;
                if (event.user_id == User.id){
                    deleteEvent(event.id);
                } else {
                    alert('Not your event');
                    args.preventDefault();
                }
            }
        };
        
        dp.onEventMoved = function(args) {
            listSchedule = [];
            var event = args.e.data;
            var result = {
                event : event.text,
                begin_at : event.start.value,
                end_at : event.end.value,
                id : event.id,
            }
            listSchedule.push(result);
            if (User.id == event.user_id ){
                updateSchedule();
            }
        };
        
        dp.onEventMove = function(args) {
            var event = args.e.data;
            if (event.user_id != User.id){
                alert('Not your event');
                args.preventDefault();
            }
        };
        
        dp.onEventDelete = function(args) {
            var event = args.e.data;
            if (event.user_id != User.id){
                alert('Not your event');
                args.preventDefault();
            }
        };
        
        dp.onEventResize = function(args) {
            var event = args.e.data;
            if (event.user_id != User.id){
                alert('Not your event');
                args.preventDefault();
            }
        };

        dp.onEventResized = function(args) {
            listSchedule = [];
            var event = args.e.data;
            var result = {
                event : event.text,
                begin_at : event.start.value,
                end_at : event.end.value,
                id : event.id,
            }
            listSchedule.push(result);
            if (User.id == event.user_id ){
                updateSchedule();
            }
        };

        var listSchedule = [];
        // dp.events.add(e);
        function pushEventList(e){
            var data = e.data;
            var result = {
                temp_id : data.id,
                event : data.text,
                begin_at : data.start.value,
                end_at : data.end.value,
                room_id : checkedLab.id,
                labname : checkedLab.name
            }
            listSchedule.push(result);
            requestSchedule()
            // renderBookList();
        }
        
        function changeLab(lab) {
            checkedLab = lab;
            loadSchedule()
        }

        function loadSchedule(){
            dp.events.list = [];
            getDataSchedule();
            dp.update();
            renderhead();
        }
        function renderhead(){
            $('#schedule').removeClass('show');
            markup =`
                <div class="row">
                    <div class="col-md-3">
                        lab: ${checkedLab.name}
                    </div>
                </div>
            `;
            $('#schedule .header').html(markup);
            $('#schedule').addClass('show');
        }
        
        function requestSchedule(){
            $.ajax({
                type: "POST",
                url: "?api=schedule",
                data: {
                    data: listSchedule,
                },
                statusCode: {
                    200: function( response ) {
                        listSchedule=[];
                        loadSchedule();
                    },
                    404: function(response) {
                        var message = response.responseJSON.meta.message;
                        $("#loginError").html(message);
                    },
                }
            });
        }
        function getDataSchedule(){
            $.ajax({
                type: "POST",
                url: "?api=schedule-show",
                data: {
                    data: {
                        'room_id':checkedLab.id,
                        'begin_at':begin_at,
                        'end_at':end_at 
                    },
                },
                statusCode: {
                    200: function( response ) {
                        eventData = response.data;
                        updateEvent();
                    },
                }
            });
        }
        function updateEvent(){
            for (i=0; i<eventData.length; i++) {
                var ev = eventData[i];
                if (User.id == parseInt(ev.user_id) ){
                        var e = new DayPilot.Event({
                        start: new DayPilot.Date(ev.begin_at),
                        end: new DayPilot.Date(ev.end_at),
                        id: ev.id,
                        text: ev.event,
                        user_id : ev.user_id,
                        "backColor": "#B6D7A8",
                        "borderColor": "#6AA84F",
                    });
                }else {
                    var e = new DayPilot.Event({
                        start: new DayPilot.Date(ev.begin_at),
                        end: new DayPilot.Date(ev.end_at),
                        id: ev.id,
                        text: ev.event,
                        user_id : ev.user_id,
                        "backColor": "#dca5a1",
                        "borderColor": "#6AA84F",
                        rightClickDisabled: true,
                        resizeDisabled: true,
                        moveDisabled: true,
                        clickDisabled: true,
                        "deleteDisabled": true,
                        doubleClickDisabled: true
                    });
                }
                dp.events.add(e);
            }
        }
        function deleteEvent(id){
            $.ajax({
                type: "POST",
                url: "?api=schedule-detroy",
                data: {
                    data: {
                        'id':id,
                    },
                },
                statusCode: {
                    200: function( response ) {
                        loadSchedule();
                    },
                    404: function(response) {
                        var message = response.responseJSON.meta.message;
                    },
                }
            });
        }

        function updateSchedule(){
            $.ajax({
                type: "POST",
                url: "?api=schedule-update",
                data: {
                    data: listSchedule,
                },
                statusCode: {
                    200: function( response ) {
                        listSchedule=[];
                        // loadSchedule();
                    },
                    404: function(response) {
                        var message = response.responseJSON.meta.message;
                    },
                }
            });
        }
    </script>
<?php endblock() ?>
<style>
    .calltoshow {
        display:none;
    }
    .calltoshow.show{
        display:block;
    }
</style>