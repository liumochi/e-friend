function initialize() {
    //创建地图实例
    var map = new BMap.Map('map');
    //创建一个坐标
    var point =new BMap.Point(113.264641,23.154905);
    //地图初始化，设置中心点坐标和地图级别
    map.centerAndZoom(point,15);
}
window.onload = initialize;