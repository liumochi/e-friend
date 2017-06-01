function initialize() {
    //创建地图实例
    var map = new BMap.Map('map');

    //创建一个坐标
    var point =new BMap.Point(113.264641,23.154905);
    var infoWindow = new BMap.InfoWindow("我在这里");    // 创建信息窗口对象
    map.openInfoWindow(infoWindow,point);
    map.centerAndZoom(point,15);

}
window.onload = initialize;