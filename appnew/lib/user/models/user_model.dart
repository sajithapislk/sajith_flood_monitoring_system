// To parse this JSON data, do
//
//     final userLoginModel = userLoginModelFromJson(jsonString);

import 'dart:convert';

UserLoginModel userLoginModelFromJson(String str) => UserLoginModel.fromJson(json.decode(str));

String userLoginModelToJson(UserLoginModel data) => json.encode(data.toJson());

class UserLoginModel {
  String accessToken;
  String tokenType;
  User user;

  UserLoginModel({
    required this.accessToken,
    required this.tokenType,
    required this.user,
  });

  factory UserLoginModel.fromJson(Map<String, dynamic> json) => UserLoginModel(
    accessToken: json["access_token"],
    tokenType: json["token_type"],
    user: User.fromJson(json["user"]),
  );

  Map<String, dynamic> toJson() => {
    "access_token": accessToken,
    "token_type": tokenType,
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
