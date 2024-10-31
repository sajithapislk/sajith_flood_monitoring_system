// To parse this JSON data, do
//
//     final userDashboardModel = userDashboardModelFromJson(jsonString);

import 'dart:convert';

UserDashboardModel userDashboardModelFromJson(String str) => UserDashboardModel.fromJson(json.decode(str));

String userDashboardModelToJson(UserDashboardModel data) => json.encode(data.toJson());

class UserDashboardModel {
  User user;
  List<Notification> notifications;
  Place nearestPlace;

  UserDashboardModel({
    required this.user,
    required this.notifications,
    required this.nearestPlace,
  });

  factory UserDashboardModel.fromJson(Map<String, dynamic> json) => UserDashboardModel(
    user: User.fromJson(json["user"]),
    notifications: List<Notification>.from(json["notifications"].map((x) => Notification.fromJson(x))),
    nearestPlace: Place.fromJson(json["nearestPlace"]),
  );

  Map<String, dynamic> toJson() => {
    "user": user.toJson(),
    "notifications": List<dynamic>.from(notifications.map((x) => x.toJson())),
    "nearestPlace": nearestPlace.toJson(),
  };
}

class Place {
  int id;
  int areaId;
  String name;
  String latitude;
  String longitude;
  int dLevel;
  int isDanger;
  DateTime createdAt;
  DateTime updatedAt;
  int? waterLevel;

  Place({
    required this.id,
    required this.areaId,
    required this.name,
    required this.latitude,
    required this.longitude,
    required this.dLevel,
    required this.isDanger,
    required this.createdAt,
    required this.updatedAt,
    required this.waterLevel,
  });

  factory Place.fromJson(Map<String, dynamic> json) => Place(
    id: json["id"],
    areaId: json["area_id"],
    name: json["name"],
    latitude: json["latitude"],
    longitude: json["longitude"],
    dLevel: json["d_level"],
    isDanger: json["is_danger"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: DateTime.parse(json["updated_at"]),
    waterLevel: json["water_level"],
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
    "water_level": waterLevel,
  };
}

class Notification {
  int id;
  int userId;
  String message;
  DateTime readAt;
  dynamic createdAt;
  DateTime updatedAt;

  Notification({
    required this.id,
    required this.userId,
    required this.message,
    required this.readAt,
    required this.createdAt,
    required this.updatedAt,
  });

  factory Notification.fromJson(Map<String, dynamic> json) => Notification(
    id: json["id"],
    userId: json["user_id"],
    message: json["message"],
    readAt: DateTime.parse(json["read_at"]),
    createdAt: json["created_at"],
    updatedAt: DateTime.parse(json["updated_at"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "user_id": userId,
    "message": message,
    "read_at": readAt.toIso8601String(),
    "created_at": createdAt,
    "updated_at": updatedAt.toIso8601String(),
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
  int riskAlert;
  List<Notification> notifications;
  List<Place> monitorPlaces;

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
    required this.riskAlert,
    required this.notifications,
    required this.monitorPlaces,
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
    riskAlert: json["risk_alert"],
    notifications: List<Notification>.from(json["notifications"].map((x) => Notification.fromJson(x))),
    monitorPlaces: List<Place>.from(json["monitor_places"].map((x) => Place.fromJson(x))),
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
    "risk_alert": riskAlert,
    "notifications": List<dynamic>.from(notifications.map((x) => x.toJson())),
    "monitor_places": List<dynamic>.from(monitorPlaces.map((x) => x.toJson())),
  };
}
