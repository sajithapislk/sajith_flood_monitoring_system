<<<<<<< Updated upstream:appnew/lib/dm/screens/home_screen.dart
=======
import 'package:appnew/auth/auth_bloc.dart';
import 'package:appnew/auth/auth_event.dart';
import 'package:appnew/auth/auth_state.dart';
import 'package:appnew/dm/screens/login_screen.dart';
import 'package:appnew/dm/screens/risk_people_screen.dart';
>>>>>>> Stashed changes:appnew/lib/dm/screens/dm_dashboard_screen.dart
import 'package:flutter/material.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({Key? key}) : super(key: key);

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {

<<<<<<< Updated upstream:appnew/lib/dm/screens/home_screen.dart
  List<Items> myList = [
    Items(
        title: "About",
        subtitle: "Information Of the System",
        img: "assets/flood.png",
        onTab: ()  => {}
    ),
    Items(
        title: "Flood Status",
        subtitle: "Monitor Place",
        img: "assets/man_walking.png",
        onTab: ()  => {}
    ),
    Items(
        title: "Risk People",
        subtitle: "how many people in your area and their are information",
        img: "assets/safety-place.png",
        onTab: ()  => {}
    ),
    Items(
        title: "Confirmed Users",
        subtitle: "Who are the confirmed of arrival of safety places ",
        img: "assets/confirmed.jpg",
        onTab: () => {},
    )
  ];
=======

>>>>>>> Stashed changes:appnew/lib/dm/screens/dm_dashboard_screen.dart

  @override
  Widget build(BuildContext context) {
    List<Items> myList = [
      Items(
          title: "About",
          subtitle: "Information Of the System",
          img: "assets/flood.png",
          onTab: () => {}
      ),
      Items(
          title: "Flood Status",
          subtitle: "Monitor Place",
          img: "assets/man_walking.png",
          onTab: () => {}
      ),
      Items(
          title: "Risk People",
          subtitle: "how many people in your area and their are information",
          img: "assets/safety-place.png",
          onTab: () => Navigator.push(
              context,
              MaterialPageRoute(
                  builder: (context) => RiskPeopleScreen()))
      ),
      Items(
        title: "Confirmed Users",
        subtitle: "Who are the confirmed of arrival of safety places ",
        img: "assets/confirmed.jpg",
        onTab: () => {},
      )
    ];

    var color = 0xff007aa5;
    return Scaffold(
      backgroundColor: const Color(0xff000080),
      body: SafeArea(
        child: Column(
          children: [
            Padding(
              padding: const EdgeInsets.only(left: 16, right: 16),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: <Widget>[
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        "dm",
                        style: const TextStyle(
                            color: Colors.white,
                            fontSize: 18,
                            fontWeight: FontWeight.bold),
                      ),
                      const SizedBox(
                        height: 4,
                      ),
                      const Text(
                        "Home",
                        style: TextStyle(
                            color: Color(0xffa29aac),
                            fontSize: 14,
                            fontWeight: FontWeight.w600),
                      ),
                    ],
                  ),
                  IconButton(
                    alignment: Alignment.topCenter,
                    icon: const Icon(Icons.exit_to_app,color: Colors.white,),
                    onPressed: () {},
                  )
                ],
              ),
            ),
            const SizedBox(
              height: 40,
            ),
            Flexible(
              child: GridView.count(
                  childAspectRatio: 1.0,
                  padding: const EdgeInsets.only(left: 16, right: 16),
                  crossAxisCount: 2,
                  crossAxisSpacing: 18,
                  mainAxisSpacing: 18,
                  children: myList.map((data) {
                    return InkWell(
                      onTap: data.onTab,
                      child: Container(
                        decoration: BoxDecoration(
                            color: Color(color),
                            borderRadius: BorderRadius.circular(10)),
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: <Widget>[
                            Image.asset(
                              data.img,
                              width: 42,
                            ),
                            const SizedBox(
                              height: 14,
                            ),
                            Text(
                              data.title,
                              style: const TextStyle(
                                  color: Colors.white,
                                  fontSize: 16,
                                  fontWeight: FontWeight.w600),
                            ),
                            const SizedBox(
                              height: 8,
                            ),
                            Text(
                              data.subtitle,
                              style: const TextStyle(
                                  color: Colors.white38,
                                  fontSize: 10,
                                  fontWeight: FontWeight.w600),
                            ),
                            const SizedBox(
                              height: 14,
                            ),
                            // Text(
                            //   data.event,
                            //   style: const TextStyle(
                            //           color: Colors.white70,
                            //           fontSize: 11,
                            //           fontWeight: FontWeight.w600
                            //   ),
                            // ),
                          ],
                        ),
                      ),
                    );
                  }).toList()),
            ),
          ],
        ),
      ),
    );
  }
}

class Items {
  String title;
  String subtitle;
  String img;
  GestureTapCallback onTab;

  Items(
      {required this.title,
        required this.subtitle,
        required this.img,
        required this.onTab});
}
