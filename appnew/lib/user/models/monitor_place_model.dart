// To parse this JSON data, do
//
//     final monitorPlaceModel = monitorPlaceModelFromJson(jsonString);

import 'dart:convert';

List<MonitorPlaceModel> monitorPlaceModelFromJson(String str) => List<MonitorPlaceModel>.from(json.decode(str).map((x) => MonitorPlaceModel.fromJson(x)));

String monitorPlaceModelToJson(List<MonitorPlaceModel> data) => json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class MonitorPlaceModel {
  int id;
  int areaId;
  String name;
  String latitude;
  String longitude;
  int dLevel;
  int isDanger;
  DateTime createdAt;
  DateTime updatedAt;
  Area area;

  MonitorPlaceModel({
    required this.id,
    required this.areaId,
    required this.name,
    required this.latitude,
    required this.longitude,
    required this.dLevel,
    required this.isDanger,
    required this.createdAt,
    required this.updatedAt,
    required this.area,
  });

  factory MonitorPlaceModel.fromJson(Map<String, dynamic> json) => MonitorPlaceModel(
    id: json["id"],
    areaId: json["area_id"],
    name: json["name"],
    latitude: json["latitude"],
    longitude: json["longitude"],
    dLevel: json["d_level"],
    isDanger: json["is_danger"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: DateTime.parse(json["updated_at"]),
    area: Area.fromJson(json["area"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "area_id": areaId,
    "name": name,
    "latitude": latitude,
    "longitude": longitude,
    "d_level": dLevel,
    "is_danger": isDanger,
    "created_at": createdAt.toIso8601String(),
    "updated_at": updatedAt.toIso8601String(),
    "area": area.toJson(),
  };
}

class Area {
  int id;
  String name;
  dynamic createdAt;
  dynamic updatedAt;

  Area({
    required this.id,
    required this.name,
    required this.createdAt,
    required this.updatedAt,
  });

  factory Area.fromJson(Map<String, dynamic> json) => Area(
    id: json["id"],
    name: json["name"],
    createdAt: json["created_at"],
    updatedAt: json["updated_at"],
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "name": name,
    "created_at": createdAt,
    "updated_at": updatedAt,
  };
}
