import 'package:appnew/user/blocs/monitorPlace/monitor_place_bloc.dart';
import 'package:appnew/user/blocs/monitorPlace/monitor_place_state.dart';
import 'package:appnew/user/screens/safe_place_screen.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import '../blocs/monitorPlace/monitor_place_event.dart';

class MonitorPlaceScreen extends StatefulWidget {
  const MonitorPlaceScreen({super.key});

  @override
  State<MonitorPlaceScreen> createState() => _MonitorPlaceScreenState();
}

class _MonitorPlaceScreenState extends State<MonitorPlaceScreen> {
  @override
  Widget build(BuildContext context) {
    return BlocProvider(
      create: (context) => MonitorPlaceBloc()..add(FetchListEvent()),
      child: Scaffold(
          appBar: AppBar(
            title: const Text("Monitoring Place"),
            actions: [IconButton(onPressed: () => {}, icon: Icon(Icons.exit_to_app))],
          ),
          body: BlocBuilder<MonitorPlaceBloc, MonitorPlaceState>(
            builder: (context, state) {
              if (state is MonitorPlaceLoaded) {
                return ListView.builder(
                    itemCount: state.list.length,
                    itemBuilder: (context, index) {
                      final item = state.list[index];
                      return Container(
                        margin: const EdgeInsets.all(10),
                        padding: const EdgeInsets.all(10),
                        height: 130,
                        width: 100,
                        decoration: BoxDecoration(
                          color: item.isDanger == 1 ? const Color(0xFFFFB4B9) : const Color(0xffefefef),
                          borderRadius: BorderRadius.circular(20),
                        ),
                        // color: Colors.red,
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.start,
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              "${item.name} ( ${item.area.name} )",
                              style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 20,
                                  color: item.isDanger == 1 ? Colors.white : Colors.black),
                            ),
                            Text(
                              "Lon:${item.longitude} | Lat:${item.latitude}",
                              style: TextStyle(
                                  fontWeight: FontWeight.normal,
                                  fontSize: 14,
                                  color: item.isDanger == 1 ? Colors.white : Colors.black),
                            ),
                            const SizedBox(
                              height: 10,
                            ),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                              children: [
                                ElevatedButton(onPressed: () {}, child: const Text("View")),
                                ElevatedButton(
                                    onPressed: () => Navigator.push(
                                        context, MaterialPageRoute(builder: (context) => SafePlaceScreen(areaId: 1))),
                                    child: const Text("Safe Place")),
                              ],
                            )
                          ],
                        ),
                      );
                    });
              }
              return Padding(
                padding: const EdgeInsets.all(8.0),
                child: Center(child: CircularProgressIndicator()),
              );
            },
          )),
    );
  }
}
