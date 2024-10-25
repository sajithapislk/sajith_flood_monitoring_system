import 'package:appnew/auth/auth_bloc.dart';
import 'package:appnew/auth/auth_event.dart';
import 'package:appnew/auth/auth_state.dart';
import 'package:appnew/dm/screens/home_screen.dart';
import 'package:appnew/user/screens/login_screen.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';


class DmLoginScreen extends StatefulWidget {
  const DmLoginScreen({super.key});

  @override
  State<DmLoginScreen> createState() => _DmLoginScreenState();
}

class _DmLoginScreenState extends State<DmLoginScreen> {
  final emailController = TextEditingController();
  final passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Column(
          children: <Widget>[
            Padding(
              padding: const EdgeInsets.only(top: 60.0),
              child: Center(
                child: Container(
                    width: 200,
                    height: 150,
                    /*decoration: BoxDecoration(
                      color: Colors.red,
                      borderRadius: BorderRadius.circular(50.0)),*/
                    child: Image.asset('assets/flood.png')),
              ),
            ),
            Padding(
                padding: const EdgeInsets.symmetric(vertical: 60),
                child: Center(
                  child: Text(
                    "DM Login",
                    style: TextStyle(
                        fontSize: 26.0,
                        fontWeight: FontWeight.bold,
                        color: Colors.blue),
                  ),
                )),
            Padding(
              //padding: const EdgeInsets.only(left:15.0,right: 15.0,top:0,bottom: 0),
              padding: EdgeInsets.symmetric(horizontal: 15),
              child: TextFormField(
                controller: emailController,
                decoration: InputDecoration(
                    border: OutlineInputBorder(),
                    labelText: 'Email',
                    hintText: 'Enter valid email id as abc@gmail.com'),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(
                  left: 15.0, right: 15.0, top: 15, bottom: 0),
              //padding: EdgeInsets.symmetric(horizontal: 15),
              child: TextFormField(
                controller: passwordController,
                obscureText: true,
                decoration: InputDecoration(
                    border: OutlineInputBorder(),
                    labelText: 'Password',
                    hintText: 'Enter secure password'),
              ),
            ),
            TextButton(
              onPressed: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(
                      builder: (context) => UserLoginScreen()),
                );
              },
              child: Text(
                'User Login',
                style: TextStyle(color: Colors.blue, fontSize: 15),
              ),
            ),
            Container(
              height: 50,
              width: 250,
              decoration: BoxDecoration(
                  color: Colors.blue, borderRadius: BorderRadius.circular(20)),
              child: BlocConsumer<AuthBloc, AuthState>(
                listener: (context, state) {
                  if (state is Authenticated) {
                    // User is authenticated, navigate to dashboard
                    Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(
                          builder: (context) => HomeScreen()),
                    );
                  }
                  if (state is AuthFailure) {
                    // Display an error message if login fails
                    ScaffoldMessenger.of(context).showSnackBar(
                      SnackBar(content: Text(state.error)),
                    );
                  }
                },
                builder: (context, state) {
                  if (state is AuthLoading) {
                    return Center(child: CircularProgressIndicator()); // Show loading on the button only
                  }
                  return TextButton(
                    onPressed: () {
                      String _email = emailController.text;
                      String _password = passwordController.text;

                      context.read<AuthBloc>().add(
                        DmLoginRequested(
                          email: _email,
                          password: _password,
                        ),
                      );
                    },
                    child: Text(
                      'Login',
                      style: TextStyle(color: Colors.white, fontSize: 25),
                    ),
                  );
                },
              ),
            ),
            SizedBox(
              height: 100,
            ),
            TextButton(
                onPressed: () => (),
                child: Text('New User? Create An Account')),
            TextButton(
                onPressed: () => (),
                child: Text('DM Login?'))
          ],
        ),
      ),
    );
  }
}
