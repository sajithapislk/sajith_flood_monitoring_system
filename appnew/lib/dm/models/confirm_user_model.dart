// To parse this JSON data, do
//
//     final confirmUserModel = confirmUserModelFromJson(jsonString);

import 'dart:convert';

List<ConfirmUserModel> confirmUserModelFromJson(String str) => List<ConfirmUserModel>.from(json.decode(str).map((x) => ConfirmUserModel.fromJson(x)));

String confirmUserModelToJson(List<ConfirmUserModel> data) => json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class ConfirmUserModel {
  int id;
  int safetyPlaceId;
  int riskUserId;
  DateTime createdAt;
  dynamic updatedAt;
  RiskUser riskUser;

  ConfirmUserModel({
    required this.id,
    required this.safetyPlaceId,
    required this.riskUserId,
    required this.createdAt,
    required this.updatedAt,
    required this.riskUser,
  });

  factory ConfirmUserModel.fromJson(Map<String, dynamic> json) => ConfirmUserModel(
    id: json["id"],
    safetyPlaceId: json["safety_place_id"],
    riskUserId: json["risk_user_id"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: json["updated_at"],
    riskUser: RiskUser.fromJson(json["risk_user"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "safety_place_id": safetyPlaceId,
    "risk_user_id": riskUserId,
    "created_at": createdAt.toIso8601String(),
    "updated_at": updatedAt,
    "risk_user": riskUser.toJson(),
  };
}

class RiskUser {
  int id;
  int userId;
  int monitorPlaceId;
  String latitude;
  String longitude;
  int distance;
  DateTime createdAt;
  dynamic updatedAt;
  User user;

  RiskUser({
    required this.id,
    required this.userId,
    required this.monitorPlaceId,
    required this.latitude,
    required this.longitude,
    required this.distance,
    required this.createdAt,
    required this.updatedAt,
    required this.user,
  });

  factory RiskUser.fromJson(Map<String, dynamic> json) => RiskUser(
    id: json["id"],
    userId: json["user_id"],
    monitorPlaceId: json["monitor_place_id"],
    latitude: json["latitude"],
    longitude: json["longitude"],
    distance: json["distance"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: json["updated_at"],
    user: User.fromJson(json["user"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "user_id": userId,
    "monitor_place_id": monitorPlaceId,
    "latitude": latitude,
    "longitude": longitude,
    "distance": distance,
    "created_at": createdAt.toIso8601String(),
    "updated_at": updatedAt,
    "user": user.toJson(),
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
  };
}
