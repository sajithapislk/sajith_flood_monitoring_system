import 'package:appnew/dm/blocs/riskPeople/risk_people_bloc.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import '../blocs/confirmUser/confirm_user_bloc.dart';
import '../blocs/confirmUser/confirm_user_event.dart';
import '../blocs/confirmUser/confirm_user_state.dart';

class ConfirmUserScreen extends StatefulWidget {
  const ConfirmUserScreen({super.key});

  @override
  State<ConfirmUserScreen> createState() => _ConfirmUserScreenState();
}

class _ConfirmUserScreenState extends State<ConfirmUserScreen> {
  @override
  Widget build(BuildContext context) {
    return BlocProvider(
      create: (context) =>
      ConfirmUserBloc()
        ..add(FetchListEvent()),
      child: Scaffold(
          appBar: AppBar(
            title: const Text("Risk People"),
            actions: [
              IconButton(
                  onPressed: () => {},
                  icon: Icon(Icons.exit_to_app))
            ],
          ),
          body: BlocBuilder<ConfirmUserBloc, ConfirmUserState>(
            builder: (context, state) {
              if(state is ConfirmUserLoaded){
                return ListView.builder(
                    itemCount: state.list.length,
                    itemBuilder: (context, index) {
                      final data = state.list[index];
                      return Container(
                        margin: const EdgeInsets.all(10),
                        padding: const EdgeInsets.all(10),
                        height: 100,
                        width: 100,
                        decoration: BoxDecoration(
                          color: Color(0xffefefef),
                          borderRadius: BorderRadius.circular(20),
                        ),
                        // color: Colors.red,
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Column(
                              mainAxisAlignment: MainAxisAlignment.start,
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Text(
                                  data.riskUser.user.name,
                                  style: TextStyle(
                                      fontWeight: FontWeight.bold,
                                      fontSize: 20,
                                      color: Colors.black),
                                ),
                                Text(
                                  data.riskUser.user.tp,
                                  style: TextStyle(
                                      fontWeight: FontWeight.normal,
                                      fontSize: 14,
                                      color: Colors.black
                                  ),
                                ),
                                Text(
                                  "Lon:${data.riskUser.longitude} Lat:${data.riskUser.latitude}",
                                  style: TextStyle(
                                      fontWeight: FontWeight.normal,
                                      fontSize: 14,
                                      color: Colors.black
                                  ),
                                ),
                              ],
                            ),
                            Text("${data.riskUser.distance} KM", style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 18,
                            ),)
                          ],
                        ),
                      );
                    }
                );
              }
              return Padding(
                padding: const EdgeInsets.all(8.0),
                child: Center(child: CircularProgressIndicator()),
              );
            },
          )

      ),
    );
  }
}
