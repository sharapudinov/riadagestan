{"version":3,"sources":["calendar-view-entry-slider.js"],"names":["window","ViewSlider","calendar","this","id","Math","round","random","sliderId","zIndex","DOM","prototype","show","params","entry","formType","BX","SidePanel","Instance","open","contentCallback","delegate","createContent","disableKeyHandler","addCustomEvent","proxy","hide","destroy","bind","document","util","applyHacksForPopupzIndex","opened","event","getSliderPage","getUrl","denyClose","denyAction","removeCustomEvent","unbind","onCustomEvent","plannerId","enableKeyHandler","userListPopup","close","setTimeout","getView","deselectEntry","isOpened","promise","Promise","ajax","get","getActionUrl","action","unique_id","form_type","sessid","bitrix_sessid","bx_event_calendar_request","entry_id","date_from","data","DATE_FROM","section_name","getSectionName","date_from_offset","TZ_OFFSET_FROM","reqId","html","fulfill","trim","initControls","initPlannerControl","initUserListControl","buttonSet","editButton","delButton","offsetHeight","addClass","entryController","canDo","editEntry","remove","deleteEntry","viewElementBind","showTitle","node","type","isElementNode","getAttribute","getCurrentStatus","initAcceptMeetingControll","sidebarInner","items","querySelectorAll","length","removeClass","copyButton","copyEventUrl","plannerWrap","offsetWidth","timeoutCheck","width","userList","y","i","q","n","isMeeting","getAttendees","forEach","user","STATUS","push","toLowerCase","showUserListPopup","userListPopupWrap","create","props","className","userWrap","appendChild","height","src","AVATAR","href","URL","text","DISPLAY_NAME","PopupWindowManager","autoHide","closeByEsc","offsetTop","offsetLeft","resizable","lightShadow","content","setAngle","offset","setStatus","SetStatusButton","wrap","currentStatus","value","changeStatusCallback","setMeetingStatus","url","getEventPath","clipboard","copy","timeoutIds","popupParams","message","darkMode","angle","popup","PopupWindow","timeoutId","pop","clearTimeout","status","updateStatus","selectorButton","events","click","showPopup","selectorButtonText","selectorButtonIcon","buttonY","buttonI","style","display","buttonN","innerHTML","menuPopup","popupWindow","isShown","menuItems","onclick","PopupMenu","BXEventCalendar","ViewEntrySlider"],"mappings":"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","file":""}