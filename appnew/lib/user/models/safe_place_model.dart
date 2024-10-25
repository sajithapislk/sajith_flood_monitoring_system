// To parse this JSON data, do
//
//     final safePlaceModel = safePlaceModelFromJson(jsonString);

import 'dart:convert';

List<SafePlaceModel> safePlaceModelFromJson(String str) => List<SafePlaceModel>.from(json.decode(str).map((x) => SafePlaceModel.fromJson(x)));

String safePlaceModelToJson(List<SafePlaceModel> data) => json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class SafePlaceModel {
  int id;
  int areaId;
  String name;
  String tp;
  String latitude;
  String longitude;
  DateTime createdAt;
  DateTime updatedAt;
  Area area;

  SafePlaceModel({
    required this.id,
    required this.areaId,
    required this.name,
    required this.tp,
    required this.latitude,
    required this.longitude,
    required this.createdAt,
    required this.updatedAt,
    required this.area,
  });

  factory SafePlaceModel.fromJson(Map<String, dynamic> json) => SafePlaceModel(
    id: json["id"],
    areaId: json["area_id"],
    name: json["name"],
    tp: json["tp"],
    latitude: json["latitude"],
    longitude: json["longitude"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: DateTime.parse(json["updated_at"]),
    area: Area.fromJson(json["area"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "area_id": areaId,
    "name": name,
    "tp": tp,
    "latitude": latitude,
    "longitude": longitude,
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
