import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import '../blocs/safePlace/safe_place_bloc.dart';
import '../blocs/safePlace/safe_place_event.dart';
import '../blocs/safePlace/safe_place_state.dart';

class SafePlaceScreen extends StatefulWidget {
  int areaId;

  SafePlaceScreen({super.key, required this.areaId});

  @override
  State<SafePlaceScreen> createState() => _SafePlaceScreenState();
}

class _SafePlaceScreenState extends State<SafePlaceScreen> {
  @override
  Widget build(BuildContext context) {
    return BlocProvider(
      create: (context) => SafePlaceBloc()..add(FetchListEvent()),
      child: Scaffold(
        appBar: AppBar(
          title: const Text("Safe Place"),
          actions: [IconButton(onPressed: () => {}, icon: Icon(Icons.exit_to_app))],
        ),
        body: Column(
          children: [
            Container(
              padding: EdgeInsets.only(top: 20),
              child: const Text(
                "Do you like to goes to the safety place, To click the confirm Button for confirmation of your arrival.",
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
            ),
            Expanded(
              child: BlocBuilder<SafePlaceBloc, SafePlaceState>(
                builder: (context, state) {
                  if (state is SafePlaceLoaded) {
                    return ListView.builder(
                        itemCount: state.list.length,
                        itemBuilder: (context, index) {
                          final data = state.list[index];
                          return Stack(
                            children: [
                              Container(
                                margin: EdgeInsets.fromLTRB(60, 10, 10, 10),
                                padding: EdgeInsets.all(10),
                                height: 160,
                                width: double.infinity,
                                decoration: BoxDecoration(
                                  color: Color(0xffefefef),
                                  borderRadius: BorderRadius.circular(20),
                                ),
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.start,
                                  crossAxisAlignment: CrossAxisAlignment.center,
                                  children: [
                                    Text(
                                      "${data.name} ( ${data.area.name} )",
                                      style: TextStyle(fontWeight: FontWeight.bold, fontSize: 20, color: Colors.black),
                                    ),
                                    Text(
                                      "Lon:${data.longitude} | Lat:${data.latitude}",
                                      style:
                                          TextStyle(fontWeight: FontWeight.normal, fontSize: 14, color: Colors.black),
                                    ),
                                    ConstrainedBox(
                                      constraints: BoxConstraints(maxWidth: 150.0),
                                      child: Row(
                                        children: [Icon(Icons.call), Text(data.tp)],
                                      ),
                                    ),
                                    SizedBox(
                                      height: 10,
                                    ),
                                    Row(
                                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                                      children: [
                                        ElevatedButton(onPressed: () => {}, child: Text("Map")),
                                        ElevatedButton(
                                          onPressed: () => {},
                                          child: Text("confirm"),
                                        ),
                                      ],
                                    )
                                  ],
                                ),
                              ),
                              Container(
                                padding: EdgeInsets.fromLTRB(10, 10, 10, 30),
                                margin: EdgeInsets.fromLTRB(10, 30, 10, 10),
                                height: 100,
                                width: 100,
                                decoration: BoxDecoration(
                                  color: Color(0xff2195F2),
                                  borderRadius: BorderRadius.circular(20),
                                ),
                                child: Image(
                                  image: AssetImage('assets/safety-place.png'),
                                  color: Colors.white,
                                ),
                              ),
                              Container(
                                padding: EdgeInsets.all(10),
                                margin: EdgeInsets.fromLTRB(35, 100, 0, 10),
                                height: 50,
                                width: 55,
                                decoration: BoxDecoration(
                                  color: Color(0xffefefef),
                                  borderRadius: BorderRadius.circular(20),
                                ),
                                child: Text("1 KM",
                                    textAlign: TextAlign.center, style: TextStyle(fontWeight: FontWeight.bold)),
                              ),
                            ],
                          );
                        });
                  }
                  return Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: Center(child: CircularProgressIndicator()),
                  );
                },
              ),
            )
          ],
        ),
      ),
    );
  }
}
