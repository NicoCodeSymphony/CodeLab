import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class Finals extends StatefulWidget {
  const Finals({super.key});

  @override
  State<Finals> createState() => _FinalsState();
}

class _FinalsState extends State<Finals> {
  TextEditingController name = TextEditingController();
  List userdata = [];

  Future<void> insertRecord() async {
    if (name.text != "") {
      try {
        String uri = "http://127.0.0.1/Finals/insert.php";

        var res = await http.post(Uri.parse(uri), body: {"name": name.text});

        var response = jsonDecode(res.body);

        if (response["success"] == "true") {
          print("Record Insert");
          name.text = "";
          // Refresh the data after inserting
          getrecord();
        } else {
          print("some issue");
        }
      } catch (e) {
        print(e);
      }
    } else {
      print("Please Fill the Field");
    }
  }

  Future<void> getrecord() async {
    String uri = "http://127.0.0.1/Finals/view_data.php";

    try {
      var response = await http.get(Uri.parse(uri));

      setState(() {
        userdata = jsonDecode(response.body);
      });
    } catch (e) {
      print(e);
    }
  }

  @override
  void initState() {
    getrecord();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Flutter Finals"),
        centerTitle: true,
      ),
      body: Column(
        children: [
          Expanded(
            child: ListView.builder(
              itemCount: userdata.length,
              itemBuilder: (context, index) {
                return Card(
                  margin: EdgeInsets.all(10),
                  child: ListTile(
                    leading: Icon(Icons.favorite),
                    title: Text(userdata[index]['name']),
                    subtitle: Text(userdata[index]['name'] + "@gmail.com"),
                  ),
                );
              },
            ),
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          openDialog();
        },
        tooltip: 'Add',
        child: Icon(Icons.add),
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.endFloat,
    );
  }

  Future openDialog() => showDialog(
    context: context,
    builder: (context) => AlertDialog(
      title: Text("YOUR NAME"),
      content: TextFormField(
        controller: name,
        decoration: InputDecoration(
          border: OutlineInputBorder(),
          labelText: "Enter your Name",
        ),
      ),
      actions: [
        TextButton(
          child: Text('Submit'),
          onPressed: () {
            insertRecord();
            Navigator.pop(context);
          },
        )
      ],
    ),
  );
}

class view_data extends StatefulWidget {
  const view_data({super.key});

  @override
  State<view_data> createState() => _view_dataState();
}

class _view_dataState extends State<view_data> {
  List userdata = [];

  Future<void> getrecord() async {
    String uri = "http://127.0.0.1/Finals/view_data.php";

    try {
      var response = await http.get(Uri.parse(uri));

      setState(() {
        userdata = jsonDecode(response.body);
      });
    } catch (e) {
      print(e);
    }
  }

  @override
  void initState() {
    getrecord();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text("VIEW DATA")),
      body: ListView.builder(
        itemCount: userdata.length,
        itemBuilder: (context, index) {
          return Card(
            margin: EdgeInsets.all(10),
            child: ListTile(
              leading: Icon(Icons.favorite),
              title: Text(userdata[index]['name']),
              subtitle: Text(userdata[index]['name'] + "@gmail.com"),
            ),
          );
        },
      ),
    );
  }
}
