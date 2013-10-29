/*
 * support classes
 */
function Schedule(unitLength) {
    //set date for
    var _self = this;
    this.unitLength = unitLength;
    this.startDate = new Date();
    this.listTimeline = [];
    this.options;

    //set height for a hour

    this.getOptions = function() {
        //Lấy danh sách các phòng học
        var options = ["D3-201", "D3-101"];
        
        this.options = options;
    }

    this.showEvents = function() {
        return _self.table;
    }
    /*
     * Thiết lập khởi tạo và các tham chiếu
     */
    this.render = function(parentId) {

        $("#" + parentId).append(_self.html);
        this.domObj = $("#gridContainer");
        this.tgTime = $("#tgTime");
        this.tgHourMakers = $("#tgHourMakers");
        this.separate = this.domObj.find(".separate");
        this.prev = this.domObj.find(".prev-btn");
        this.next = this.domObj.find(".next-btn");

        //Tham chiếu tập các header
        this.t2H = this.domObj.find(".h-col-t2");
        this.t3H = this.domObj.find(".h-col-t3");
        this.t4H = this.domObj.find(".h-col-t4");
        this.t5H = this.domObj.find(".h-col-t5");
        this.t6H = this.domObj.find(".h-col-t6");
        
        //lấy danh sách các option        
        this.getOptions();

        for (var i = 0; i < 6; i++) {
            this.tgTime.append("<div style='height:" + (2 * _self.unitLength) + "px;padding-top:-1px'><div class='tg-time-pri' style='height:" + (2 * _self.unitLength - 2) + "px;'>Tiết " + (i + 1) + "</div></div>");
            this.tgHourMakers.append("<div class='tg-markercell'></div>");
        }
        this.tgTime.append("<div style='height:" + (2 * _self.unitLength) + "px;padding-top:-1px'><div class='tg-time-pri' style='height:" + (2 * _self.unitLength - 2) + "px;'></div></div>");
        this.tgHourMakers.append("<div class='separate' style='height:" + (2 * _self.unitLength) + "px'></div>");

        for (var i = 6; i < 12; i++) {
            this.tgTime.append("<div style='height:" + (2 * _self.unitLength) + "px;padding-top:-1px'><div class='tg-time-pri' style='height:" + (2 * _self.unitLength - 2) + "px;'>Tiết " + (i + 1) + "</div></div>");
            this.tgHourMakers.append("<div class='tg-markercell'></div>");
        }

        this.startDate.setDate(this.startDate.getDate() - this.startDate.getDay() + 1)
        var temDate = new Date(this.startDate.getTime());
        for (var i = 0; i < 5; i++) {

            this.listTimeline[i] = (new TimeLine(("tgCol" + i), _self.unitLength, new Date(temDate.getTime()), _self.options));
            this.listTimeline[i].render();
            this["t" + (i + 2) + "H"].text(temDate.toDateString());
            temDate.setDate(temDate.getDate() + 1);
        }
        $(".tg-markercell").css("height", (2 * _self.unitLength - 2) + "px");
        this.bindEvent();
        
    }
    /*
     * Khởi tạo tuần mới
     */
    this.reset = function(newWeek) {
        this.startDate = newWeek;
        this.startDate.setDate(this.startDate.getDate() - this.startDate.getDay() + 1);
        var temDate = new Date(this.startDate.getTime());
        for (var i = 0; i < 5; i++) {
            this.listTimeline[i].setDate(new Date(temDate.getTime()));
            this["t" + (i + 2) + "H"].text(temDate.toDateString());
            temDate.setDate(temDate.getDate() + 1);
        }
    }
    this.bindEvent = function() {
        this.prev.bind("click", function() {
            var temDate = new Date(_self.startDate.getTime());
            temDate.setDate(temDate.getDate() - 7);
            _self.reset(temDate);
        });
        this.next.bind("click", function() {
            var temDate = new Date(_self.startDate.getTime());
            temDate.setDate(temDate.getDate() + 7);
            _self.reset(temDate);
        });
    }
    
    /*
     * Lấy thông tin chi tiết lịch mượn (start, end, room, date)
     */
    this.getPeriods = function(){
        var result = [];
        for (var i = 0; i < 5; i++) {
            result = result.concat(this.listTimeline[i].generateDetail());
        }
        return result;
    }
    /*
     * Thêm tiết học mới theo(start, end, dayofweek)
     */
    this.addWeekPeriod = function(start, end, weekday, room){
 		 for (var i = 0; i < 5; i++) {
 		 	if((this.listTimeline[i].date.getDay() + 1) == weekday){
 		 		this.listTimeline[i].addWeeklyPeriod(start,end,room);
 		 	}
 		 }
    }
}