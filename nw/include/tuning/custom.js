$(document).ready(function() {

    document.addEventListener('rs.tuning.onBeforeGetReadyMacros', function(e) {

        var macrosList = e.detail.macrosList;
            color11 = macrosList['COLOR_1_1'],
            rsColor11 = new RS.Color(color11),
            color12 = macrosList['COLOR_1_2'],
            rsColor12 = new RS.Color(color12);
        
        rsTuning.setMacros('COLOR_1_1_DARKEN_7_PERSENT', rsColor11.darken(7).getHex());
        rsTuning.setMacros('COLOR_1_1_DARKEN_10_PERSENT', rsColor11.darken(10).getHex());
        rsTuning.setMacros('COLOR_1_1_GRADIENT', rsColor11.adjustHue(-34).saturate(0.05).lighten(1.37).getHex());
    });

});
