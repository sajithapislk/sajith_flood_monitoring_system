import 'package:appnew/dm/blocs/riskPeople/risk_people_bloc.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

class RiskPeopleScreen extends StatefulWidget {
  const RiskPeopleScreen({super.key});

  @override
  State<RiskPeopleScreen> createState() => _RiskPeopleScreenState();
}

class _RiskPeopleScreenState extends State<RiskPeopleScreen> {
  @override
  Widget build(BuildContext context) {
    return BlocProvider(
      create: (context) =>
      RiskPeopleBloc()
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
          body: BlocBuilder<RiskPeopleBloc, RiskPeopleState>(
            builder: (context, state) {
              if(state is MonitorPlaceLoaded){
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
                                  data.user.name,
                                  style: TextStyle(
                                      fontWeight: FontWeight.bold,
                                      fontSize: 20,
                                      color: Colors.black),
                                ),
                                Text(
                                  data.user.tp,
                                  style: TextStyle(
                                      fontWeight: FontWeight.normal,
                                      fontSize: 14,
                                      color: Colors.black
                                  ),
                                ),
                                Text(
                                  "Lon:${data.longitude} Lat:${data.latitude}",
                                  style: TextStyle(
                                      fontWeight: FontWeight.normal,
                                      fontSize: 14,
                                      color: Colors.black
                                  ),
                                ),
                              ],
                            ),
                            Text("${data.distance} KM", style: TextStyle(
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
