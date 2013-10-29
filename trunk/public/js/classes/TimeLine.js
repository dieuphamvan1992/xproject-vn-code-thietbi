function TimeLine(id, unit, date, options) {
    var _self = this;
    this.domObj = $("#" + id);
    this.unitLength = 2 * unit;
    //tham chiếu đến độ dài hiển thị của 1 tiết học
    this.listPeriod = [];
    //lưu trữ danh sách các tiết mượn trong ngày
    this.counter = 0;
    this.options = options;
    /*
     * Thiết lập ngày mà timeline biểu diễn
     */
    this.setDate = function(newDate) {
        this.counter = 0;
        this.domObj.html("<div class='tem-period'></div>");
        this.temPeriod = this.domObj.find(".tem-period");
        _self.listPeriod = []
        //lấy danh sách các tiết mượn trong newDate
        var listPeriods = [];

        this.date = newDate;
        this.show(listPeriods);
    }
    /*
     *
     */
    this.render = function() {
        this.domObj.css("height", this.unitLength * 13);
        this.setDate(date);
       if(navigator.userAgent.match(/iPhone/i) ||navigator.userAgent.match(/Android/i) ){
			alert("IPad");
			_self.addTabletEvents();
			
		}else{
			_self.addEvents();
		}
    }
    /*
     *
     */
    this.addEvents = function() {
        //create a event by click
        _self.domObj.bind("dblclick", function(event) {
            var unit = Math.floor((event.pageY - _self.domObj.offset().top) / _self.unitLength);
            _self.createPeriod({
                height : _self.unitLength,
                top : unit * _self.unitLength
            });
        });

        //scale for create event
        this.temMouse = 0;
        this.mouseHold = false;
        this.domObj.bind("mousedown", function(e) {
            _self.temMouse = Math.floor((e.pageY - _self.domObj.offset().top) / _self.unitLength);

            _self.temPeriod.css({
                display : "block",
                top : _self.temMouse * _self.unitLength,
                height : "0px"
            });
            _self.mouseHold = true;
        });
        this.domObj.bind("mousemove", function(e) {
            if (_self.mouseHold) {
                var currentMouse = Math.ceil((e.pageY - _self.domObj.offset().top) / _self.unitLength);
                if (currentMouse > _self.temMouse) {
                    _self.temPeriod.css("height", (currentMouse - _self.temMouse) * _self.unitLength + "px");
                } else {
                    _self.temPeriod.css("height", "0px");

                }
            }
        });
        this.domObj.bind("mouseup", function(e) {
            if (_self.temPeriod.height() > 0 && _self.mouseHold == true) {
                _self.createPeriod({
                    height : _self.temPeriod.height(),
                    top : _self.temPeriod.position().top
                });
                _self.mouseHold = false;
            }
            _self.temPeriod.hide();
        });
        this.domObj.mouseleave(function() {
            if (_self.mouseHold) {
                _self.mouseHold = false;
                _self.temPeriod.hide();
            }
        });
    }
     /*
     *
     */
    this.addTabletEvents = function() {
        //create a event by click
        _self.domObj.bind("vclick", function(event) {
            var unit = Math.floor((event.pageY - _self.domObj.offset().top) / _self.unitLength);
            _self.createPeriod({
                height : _self.unitLength,
                top : unit * _self.unitLength
            });
        });

        //scale for create event
        this.temMouse = 0;
        this.mouseHold = false;
        this.domObj.bind("vmousedown", function(e) {
            _self.temMouse = Math.floor((e.pageY - _self.domObj.offset().top) / _self.unitLength);

            _self.temPeriod.css({
                display : "block",
                top : _self.temMouse * _self.unitLength,
                height : "0px"
            });
            _self.mouseHold = true;
        });
        this.domObj.bind("vmousemove", function(e) {
            if (_self.mouseHold) {
                var currentMouse = Math.ceil((e.pageY - _self.domObj.offset().top) / _self.unitLength);
                if (currentMouse > _self.temMouse) {
                    _self.temPeriod.css("height", (currentMouse - _self.temMouse) * _self.unitLength + "px");
                } else {
                    _self.temPeriod.css("height", "0px");

                }
            }
        });
        this.domObj.bind("vmouseup", function(e) {
            if (_self.temPeriod.height() > 0 && _self.mouseHold == true) {
                _self.createPeriod({
                    height : _self.temPeriod.height(),
                    top : _self.temPeriod.position().top
                });
                _self.mouseHold = false;
            }
            _self.temPeriod.hide();
        });
        this.domObj.vmouseout(function() {
            if (_self.mouseHold) {
                _self.mouseHold = false;
                _self.temPeriod.hide();
            }
        });
    }
    /*
     *
     */
    _self.createPeriod = function(config) {
        var paramaters = {
            parent : _self,
            id : (_self.date.valueOf()) + "" + _self.counter,
            top : config.top,
            height : config.height,
            options : _self.options
        };
        var newPeriod = new Period();
        newPeriod.render(paramaters);
        _self.addPeriod(newPeriod);
    }
    /*
     * Hiển thị danh sách các tiết mượn
     */
    this.show = function(listPeriods) {
        for (var i = 0; i < listPeriods.length; i++) {
             var paramaters = {
                top : (listPeriods[i].start - 1) * _self.unitLength,
                height : (listPeriods[i].end -listPeriods[i].start + 1)* _self.unitLength,
                room: listPeriods[i].room
            };
            _self.createPeriod(paramaters);
        }
    }
    /*
     * Kiểm tra tính hợp lệ của sự kiện mới tạo
     */
    this.checkAllow = function(top, bottom, element) {
        for (var i = 0; i < this.listPeriod.length; i++) {
            var period = this.listPeriod[i];
            if (this.listPeriod[i].id != element.id) {
                if ((top == period.start) || (top - period.start) * (bottom - period.start) < 0 || (top - period.start) * (top - period.end) < 0) {
                    return false;
                }
            }
        }
        return true;
    }
    /*
     * Thiết lập danh sách các phòng  học
     */
    this.setOptions = function(options) {
        this.options = options;
    }
    /*
     * Thêm sửa xóa các tiết học
     */
    this.addPeriod = function(period) {
        this.listPeriod.push(period);
        _self.counter = _self.counter + 1;
    }
    this.delPeriod = function(period) {
        // this.listPeriod.
        for (var i = 0; i < this.listPeriod.length; i++) {
            if (this.listPeriod[i].id == period.id) {
                this.listPeriod.splice(i,1);
            }
        }
    }
    /*
     * Lấy thông tin chi tiết các tiết học trong ngày(start, end, date, room)
     */
    this.generateDetail = function() {
        var result = [];
        for (var i = 0; i < this.listPeriod.length; i++) {
            var temDetail = this.listPeriod[i].generateDetail();
            result.push({
               start: temDetail.start,
               end: temDetail.end,
               date: _self.date,
               room: temDetail.room 
            });
        }
        
        return result;
    }
    /*
     * Thêm một tiết học vào buổi học
     */
    this.addWeeklyPeriod = function(start, end, room){
    	if(start > 6){
    		start++;
    		end++;
    	}
    	var paramaters = {
            parent : _self,
            id : (_self.date.valueOf()) + "" + _self.counter,
            top : (start - 1) * _self.unitLength,
            height : (end - start + 1)* _self.unitLength,
            options : _self.options,
            room: room
        };
        var newPeriod = new Period();
        newPeriod.render(paramaters);
        _self.addPeriod(newPeriod);
    }
}
