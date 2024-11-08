// To parse this JSON data, do
//
//     final userRegisterResponseModel = userRegisterResponseModelFromJson(jsonString);

import 'dart:convert';

UserRegisterResponseModel userRegisterResponseModelFromJson(String str) => UserRegisterResponseModel.fromJson(json.decode(str));

String userRegisterResponseModelToJson(UserRegisterResponseModel data) => json.encode(data.toJson());

class UserRegisterResponseModel {
  User user;
  String token;

  UserRegisterResponseModel({
    required this.user,
    required this.token,
  });

  factory UserRegisterResponseModel.fromJson(Map<String, dynamic> json) => UserRegisterResponseModel(
    user: User.fromJson(json["user"]),
    token: json["token"],
  );

  Map<String, dynamic> toJson() => {
    "user": user.toJson(),
    "token": token,
  };
}

class User {
  String name;
  String email;
  String tp;
  int areaId;
  String guardianName;
  String guardianTp;
  DateTime updatedAt;
  DateTime createdAt;
  int id;

  User({
    required this.name,
    required this.email,
    required this.tp,
    required this.areaId,
    required this.guardianName,
    required this.guardianTp,
    required this.updatedAt,
    required this.createdAt,
    required this.id,
  });

  factory User.fromJson(Map<String, dynamic> json) => User(
    name: json["name"],
    email: json["email"],
    tp: json["tp"],
    areaId: json["area_id"],
    guardianName: json["guardian_name"],
    guardianTp: json["guardian_tp"],
    updatedAt: DateTime.parse(json["updated_at"]),
    createdAt: DateTime.parse(json["created_at"]),
    id: json["id"],
  );

  Map<String, dynamic> toJson() => {
    "name": name,
    "email": email,
    "tp": tp,
    "area_id": areaId,
    "guardian_name": guardianName,
    "guardian_tp": guardianTp,
    "updated_at": updatedAt.toIso8601String(),
    "created_at": createdAt.toIso8601String(),
    "id": id,
  };
}
