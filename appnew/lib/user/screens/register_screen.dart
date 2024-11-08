import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import '../../auth/auth_bloc.dart';
import '../../auth/auth_event.dart';
import '../../auth/auth_state.dart';
import '../blocs/area/area_bloc.dart';
import '../blocs/area/area_event.dart';
import '../blocs/area/area_state.dart';
import '../models/area_model.dart';
import 'login_screen.dart';
import 'user_dashboard_screen.dart';

class RegisterScreen extends StatefulWidget {
  const RegisterScreen({super.key});

  @override
  State<RegisterScreen> createState() => _RegisterScreenState();
}

class _RegisterScreenState extends State<RegisterScreen> {
  final emailController = TextEditingController();
  final passwordController = TextEditingController();
  final nameController = TextEditingController();
  final tpController = TextEditingController();
  final guardianNameController = TextEditingController();
  final guardianTpController = TextEditingController();
  String? _selectedAreaId;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 24.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: <Widget>[
              const SizedBox(height: 60.0),
              Center(
                child: Image.asset(
                  'assets/flood.png',
                  width: 150,
                  height: 150,
                ),
              ),
              const SizedBox(height: 20.0),
              const Text(
                "User Registration",
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 28.0,
                  fontWeight: FontWeight.bold,
                  color: Colors.blue,
                ),
              ),
              const SizedBox(height: 40.0),
              _buildTextField(
                controller: emailController,
                labelText: 'Email',
                hintText: 'Enter your email',
                keyboardType: TextInputType.emailAddress,
              ),
              const SizedBox(height: 20.0),
              _buildTextField(
                controller: nameController,
                labelText: 'Full Name',
                hintText: 'Enter your full name',
              ),
              const SizedBox(height: 20.0),
              _buildTextField(
                controller: tpController,
                labelText: 'Phone Number',
                hintText: 'Enter your phone number',
                keyboardType: TextInputType.phone,
              ),
              const SizedBox(height: 20.0),
              _buildTextField(
                controller: passwordController,
                labelText: 'Password',
                hintText: 'Enter a secure password',
                obscureText: true,
              ),
              const SizedBox(height: 20.0),
              _buildTextField(
                controller: guardianNameController,
                labelText: 'Guardian Name',
                hintText: 'Enter guardian name',
              ),
              const SizedBox(height: 20.0),
              _buildTextField(
                controller: guardianTpController,
                labelText: 'Guardian Phone Number',
                hintText: 'Enter guardian phone number',
                keyboardType: TextInputType.phone,
              ),
              const SizedBox(height: 20.0),
              _buildAreaDropdown(),
              const SizedBox(height: 30.0),
              _buildRegisterButton(context),
              const SizedBox(height: 20.0),
              Center(
                child: TextButton(
                  onPressed: () {
                    Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(builder: (context) => const UserLoginScreen()),
                    );
                  },
                  child: const Text(
                    'District Magistrate Officer Login',
                    style: TextStyle(
                      color: Colors.blue,
                      fontSize: 16.0,
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildTextField({
    required TextEditingController controller,
    required String labelText,
    String? hintText,
    bool obscureText = false,
    TextInputType keyboardType = TextInputType.text,
  }) {
    return TextFormField(
      controller: controller,
      obscureText: obscureText,
      keyboardType: keyboardType,
      decoration: InputDecoration(
        labelText: labelText,
        hintText: hintText,
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(8.0),
        ),
        filled: true,
        fillColor: Colors.grey[100],
        contentPadding: const EdgeInsets.symmetric(vertical: 15.0, horizontal: 10.0),
      ),
    );
  }

  Widget _buildAreaDropdown() {
    return BlocProvider(
      create: (context) => AreaBloc()..add(LoadAreas()),
      child: BlocBuilder<AreaBloc, AreaState>(
        builder: (context, state) {
          if (state is AreaLoaded) {
            return DropdownButtonFormField<String>(
              hint: const Text("Select an area"),
              value: _selectedAreaId,
              onChanged: (String? newValue) {
                setState(() {
                  _selectedAreaId = newValue;
                });
              },
              items: state.areas.map<DropdownMenuItem<String>>((AreaModel area) {
                return DropdownMenuItem<String>(
                  value: area.id.toString(),
                  child: Text(area.name),
                );
              }).toList(),
              decoration: InputDecoration(
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(8.0),
                ),
                filled: true,
                fillColor: Colors.grey[100],
                contentPadding: const EdgeInsets.symmetric(vertical: 15.0, horizontal: 10.0),
              ),
            );
          }
          return const Center(child: CircularProgressIndicator());
        },
      ),
    );
  }

  Widget _buildRegisterButton(BuildContext context) {
    return BlocConsumer<AuthBloc, AuthState>(
      listener: (context, state) {
        if (state is Authenticated) {
          Navigator.pushReplacement(
            context,
            MaterialPageRoute(builder: (context) => const UserDashboardScreen()),
          );
        } else if (state is AuthFailure) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text(state.error)),
          );
        }
      },
      builder: (context, state) {
        if (state is AuthLoading) {
          return const Center(child: CircularProgressIndicator());
        }
        return ElevatedButton(
          onPressed: () {
            String name = nameController.text;
            String email = emailController.text;
            String phone = tpController.text;
            String password = passwordController.text;
            String guardianName = guardianNameController.text;
            String guardianPhone = guardianTpController.text;

            if (_selectedAreaId == null) {
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(content: Text('Please select an area')),
              );
              return;
            }

            context.read<AuthBloc>().add(
              RegisterRequested(
                fullName: name,
                email: email,
                password: password,
                phoneNumber: phone,
                guardianName: guardianName,
                guardianTp: guardianPhone,
                areaId: int.parse(_selectedAreaId!),
              ),
            );
          },
          style: ElevatedButton.styleFrom(
            backgroundColor: Colors.blue,
            padding: const EdgeInsets.symmetric(vertical: 15.0),
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(8.0),
            ),
          ),
          child: const Text(
            'Register',
            style: TextStyle(fontSize: 18, color: Colors.white),
          ),
        );
      },
    );
  }
}