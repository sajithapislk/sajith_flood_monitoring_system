// To parse this JSON data, do
//
//     final dmLoginModel = dmLoginModelFromJson(jsonString);

import 'dart:convert';

DmLoginModel dmLoginModelFromJson(String str) => DmLoginModel.fromJson(json.decode(str));

String dmLoginModelToJson(DmLoginModel data) => json.encode(data.toJson());

class DmLoginModel {
  Dm dm;
  String token;

  DmLoginModel({
    required this.dm,
    required this.token,
  });

  factory DmLoginModel.fromJson(Map<String, dynamic> json) => DmLoginModel(
    dm: Dm.fromJson(json["dm"]),
    token: json["token"],
  );

  Map<String, dynamic> toJson() => {
    "dm": dm.toJson(),
    "token": token,
  };
}

class Dm {
  int id;
  String name;
  int areaId;
  String email;
  String tp;
  dynamic emailVerifiedAt;
  dynamic tpVerifiedAt;
  DateTime createdAt;
  DateTime updatedAt;

  Dm({
    required this.id,
    required this.name,
    required this.areaId,
    required this.email,
    required this.tp,
    required this.emailVerifiedAt,
    required this.tpVerifiedAt,
    required this.createdAt,
    required this.updatedAt,
  });

  factory Dm.fromJson(Map<String, dynamic> json) => Dm(
    id: json["id"],
    name: json["name"],
    areaId: json["area_id"],
    email: json["email"],
    tp: json["tp"],
    emailVerifiedAt: json["email_verified_at"],
    tpVerifiedAt: json["tp_verified_at"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: DateTime.parse(json["updated_at"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "name": name,
    "area_id": areaId,
    "email": email,
    "tp": tp,
    "email_verified_at": emailVerifiedAt,
    "tp_verified_at": tpVerifiedAt,
    "created_at": createdAt.toIso8601String(),
    "updated_at": updatedAt.toIso8601String(),
  };
}
