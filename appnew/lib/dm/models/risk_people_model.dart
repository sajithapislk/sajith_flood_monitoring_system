// To parse this JSON data, do
//
//     final riskPeopleModel = riskPeopleModelFromJson(jsonString);

import 'dart:convert';

List<RiskPeopleModel> riskPeopleModelFromJson(String str) => List<RiskPeopleModel>.from(json.decode(str).map((x) => RiskPeopleModel.fromJson(x)));

String riskPeopleModelToJson(List<RiskPeopleModel> data) => json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class RiskPeopleModel {
  int id;
  int userId;
  int monitorPlaceId;
  String latitude;
  String longitude;
  int distance;
  DateTime? createdAt;
  dynamic updatedAt;
  User user;
  MonitorPlaces monitorPlaces;

  RiskPeopleModel({
    required this.id,
    required this.userId,
    required this.monitorPlaceId,
    required this.latitude,
    required this.longitude,
    required this.distance,
    required this.createdAt,
    required this.updatedAt,
    required this.user,
    required this.monitorPlaces,
  });

  factory RiskPeopleModel.fromJson(Map<String, dynamic> json) => RiskPeopleModel(
    id: json["id"],
    userId: json["user_id"],
    monitorPlaceId: json["monitor_place_id"],
    latitude: json["latitude"],
    longitude: json["longitude"],
    distance: json["distance"],
    createdAt: json["created_at"] == null ? null : DateTime.parse(json["created_at"]),
    updatedAt: json["updated_at"],
    user: User.fromJson(json["user"]),
    monitorPlaces: MonitorPlaces.fromJson(json["monitor_places"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "user_id": userId,
    "monitor_place_id": monitorPlaceId,
    "latitude": latitude,
    "longitude": longitude,
    "distance": distance,
    "created_at": createdAt?.toIso8601String(),
    "updated_at": updatedAt,
    "user": user.toJson(),
    "monitor_places": monitorPlaces.toJson(),
  };
}

class MonitorPlaces {
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

  MonitorPlaces({
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

  factory MonitorPlaces.fromJson(Map<String, dynamic> json) => MonitorPlaces(
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

class User {
  int id;
  String name;
  String guardianName;
  int areaId;
  String email;
  String tp;
  String guardianTp;
  dynamic emailVerifiedAt;
  dynamic tpVerifiedAt;
  DateTime createdAt;
  DateTime updatedAt;

  User({
    required this.id,
    required this.name,
    required this.guardianName,
    required this.areaId,
    required this.email,
    required this.tp,
    required this.guardianTp,
    required this.emailVerifiedAt,
    required this.tpVerifiedAt,
    required this.createdAt,
    required this.updatedAt,
  });

  factory User.fromJson(Map<String, dynamic> json) => User(
    id: json["id"],
    name: json["name"],
    guardianName: json["guardian_name"],
    areaId: json["area_id"],
    email: json["email"],
    tp: json["tp"],
    guardianTp: json["guardian_tp"],
    emailVerifiedAt: json["email_verified_at"],
    tpVerifiedAt: json["tp_verified_at"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: DateTime.parse(json["updated_at"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "name": name,
    "guardian_name": guardianName,
    "area_id": areaId,
    "email": email,
    "tp": tp,
    "guardian_tp": guardianTp,
    "email_verified_at": emailVerifiedAt,
    "tp_verified_at": tpVerifiedAt,
    "created_at": createdAt.toIso8601String(),
    "updated_at": updatedAt.toIso8601String(),
  };
}
