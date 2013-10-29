function Period() {
    var _self = this;
    //run when create
    this.render = function(config) {
        this.element = "<div class='block' id='" + config.id + "'><div class='container'>" + "<div class='close'>x</div>" + "<div class='title'></div>" + "<select class='opt-value'></select>" + "<div class='resizer'><div class='icon-resizer'></div></div>" + "</div>";
        this.parent = config.parent;
        this.parent.domObj.append(this.element);
        //set new id for modelEvent
        this.domObj = $("#" + config.id);
        this.id = config.id;
        this.reset();
        for (var i = 0; i < config.options.length; i++) {
            this.optionBox.append("<option value='" + config.options[i] + "'>" + config.options[i] + "</options>");
        }
        if (config.room != null) {
            this.optionBox.val(config.room);
        }
        this.setPosition(config.top, config.height);

    }
    //attach event for div tag
    this.addEvents = function() {
        //catch resize event
        var resizerHolded = false;
        var movedHolded = false;
        var oldPageY;
        this.resizer.bind("mousedown", function(event) {
            resizerHolded = true;
            oldPageY = event.pageY;
            event.stopPropagation();
        });
        this.resizer.bind("mousemove", function(event) {
            if (resizerHolded == true) {
                var temOffset = event.pageY - oldPageY;
                if (temOffset > 1) {
                    movedHolded = true;
                }
                if ((temOffset + _self.domObj.height() ) < 0) {
                    _self.domObj.css("height", _self.parent.unitLength + "px");
                } else {
                    _self.domObj.css("height", (_self.domObj.height() + temOffset) + "px");
                }
                oldPageY = event.pageY;
            }
            event.stopPropagation();
        });
        this.resizer.bind("mouseup", function(event) {
            // this.updateEvent();
            if (resizerHolded) {
                _self.setHeight(_self.domObj.height());
                _self.setPosition(_self.domObj.position().top, _self.domObj.height());
                resizerHolded = false;
            }
            event.stopPropagation();
        });
        this.resizer.mouseleave(function() {
            if (resizerHolded == true) {
                _self.setHeight();
                resizerHolded = false
                //update
            }
        });

        this.domObj.bind("dblclick", function(event) {
            _self.removePeriod();
            event.stopPropagation();
        });

        this.domObj.bind("click", function(event) {
            event.preventDefault();
        });
        this.domObj.bind("mouseover", function(event) {
            if (_self.parent.mouseHold) {
                _self.parent.mouseHold = false;
                _self.parent.temPeriod.hide();
            }
            event.stopPropagation();
        });
        //drag event to other period
        var oldOffset;
        var clickedDomObj = false;
        var oldPageY;
        this.domObj.bind("mousedown", function(event) {
            oldPageY = event.pageY;
            oldOffset = event.pageY;
            clickedDomObj = true;
            event.stopPropagation();
        });
        this.domObj.bind("mousemove", function(event) {
            if (clickedDomObj == true) {
                var temOffset = event.pageY - oldOffset;
                if (_self.allowChange(temOffset)) {
                    _self.domObj.css("top", temOffset + _self.domObj.position().top);
                }
                oldOffset = oldOffset + temOffset;

            }
            event.stopPropagation();
        });

        this.domObj.bind("mouseup", function(event) {
            if (event.pageY == oldPageY) {
                clickedDomObj = false;
            }
            if (clickedDomObj) {
                clickedDomObj = false;
                //update time for event
                _self.setPosition(_self.domObj.position().top, _self.domObj.height());
            }
            event.stopPropagation();
        });
        this.domObj.mouseleave(function() {
            if (clickedDomObj) {
                _self.setTop();
                clickedDomObj = false;
            }
        });
        this.close.bind("click", function() {
            _self.removePeriod();
        });
    }

    this.allowChange = function(offset) {
        var top = (_self.domObj.position().top + offset) / _self.parent.unitLength;
        var bottom = top + (_self.domObj.height()) / _self.parent.unitLength;
        if (bottom > 13 || top < 0 || (top > 6 && top < 7) || (bottom > 6 && bottom < 7) || (!_self.parent.checkAllow(top, bottom, this))) {
            // _self.domObj.css("top", 7 * _self.parent.unitLength);
            return false;
        } else {
            return true;
        }
    }
    //set time for modelEvent and relocate event div
    this.setPosition = function(top, height) {
        //convert to txt
        _self.start = Math.round(top / _self.parent.unitLength);
        _self.end = _self.start + Math.round(height / _self.parent.unitLength);

        _self.domObj.css("top", _self.start * _self.parent.unitLength);
       

        if ((_self.start + 1) >= _self.end) {
            if (_self.start > 6) {
                _self.title.text("T" + (_self.start));
            }else{
                _self.title.text("T" + (_self.start + 1));
            }
        } else {
            if (_self.start > 6) {
                _self.title.text("T" + (_self.start ) + "-T" + (_self.end - 1));
            }else{
                _self.title.text("T" + (_self.start + 1) + "-T" + (_self.end));
            }
            
        }
         _self.domObj.css("height", (_self.end - _self.start) * _self.parent.unitLength);
    }

    this.setId = function(id) {
        this.domObj.attr("id", id);
        //set new id for modelEvent
        this.domObj = $("#" + id);
        this.reset();
    }
    this.reset = function() {
        this.resizer = this.domObj.find(".resizer");
        this.title = this.domObj.find(".title");
        this.optionBox = this.domObj.find(".opt-value");
        this.close = this.domObj.find(".close");
        this.addEvents();
    }
    /*
     * Tự động chỉnh vị trí về đúng tiết học trên thời khóa biểu
     */
    this.setTop = function() {
        _self.domObj.css("top", Math.floor(_self.domObj.position().top / _self.parent.unitLength) * _self.parent.unitLength);
    }
    this.setHeight = function() {
        var index = _self.start + Math.ceil(_self.domObj.height() / _self.parent.unitLength);
        if (index == 7) {
            index = 6;
        }
        if (index > 13) {
            index = 13;
        }
        _self.end = index;
        _self.domObj.css("height", (index - _self.start) * _self.parent.unitLength);
    }
    /*
     * Hiển thị tiết mượn trên thời khóa biểu, đầu vào là tiết bắt đầu và tiết kết thúc
     * generateView(1,2)
     */
    this.generateView = function(config) {
        this.setPosition(config.startTime * (_self.parent.unitLength), (config.endTime - config.startTime) * _self.parent.unitLength);
        this.title.text("T" + config.startTime + "-" + "T" + config.endTime);
    }
    /*
     * lấy tiết bắt đầu và kết thúc
     */
    this.getTime = function() {
        var start = Math.round(_self.domObj.position().top / _self.parent.unitLength);
        var end = _self.start + Math.round(_self.domObj.height() / _self.parent.unitLength);
        if (_self.start > 6) {
            start = start - 1;
            end = end - 1;
        }
        return {
            start : start + 1,
            end : end
        };
    }
    /*
     * Xóa
     */
    this.removePeriod = function() {
        _self.parent.delPeriod(this);
        this.domObj.remove();
        delete this;
    }
    /*
     * Trả về đối tượng biểu diễn tiết học ( start, end, room)
     */
    this.generateDetail = function(){
        return {
            start: _self.getTime().start,
            end: _self.getTime().end,
            room: _self.optionBox.val()
        }       
    }
}

function PeriodModel() {
}
