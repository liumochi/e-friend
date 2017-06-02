function initialize() {
    //创建地图实例
    var map = new BMap.Map('map');

    //创建一个坐标
    var point =new BMap.Point(126.6257609130,45.7145616325);
    var infoWindow = new BMap.InfoWindow("我在这里");    // 创建信息窗口对象
    map.openInfoWindow(infoWindow,point);
    map.setCurrentCity("哈尔滨");
    map.enableScrollWheelZoom(true);
    map.centerAndZoom(point,15);
    var marker = new BMap.Marker(point);  　　　　　 // 创建标注
    map.addOverlay(marker);
    var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
    var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
    var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); //右上角，仅包含平移和缩放按钮
    /*缩放控件type有四种类型:
     BMAP_NAVIGATION_CONTROL_SMALL：仅包含平移和缩放按钮；BMAP_NAVIGATION_CONTROL_PAN:仅包含平移按钮；BMAP_NAVIGATION_CONTROL_ZOOM：仅包含缩放按钮*/
    map.addControl(top_left_control);
    map.addControl(top_left_navigation);
    map.addControl(top_right_navigation);

}
window.onload = initialize;