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
  TextEditingController priceController = TextEditingController();
  TextEditingController numItemController = TextEditingController();

  List userdata = [];

  Future<void> insertRecord() async {
    if (name.text != "") {
      try {
        String uri = "http://127.0.0.1/Finals/insert.php";

        // Get the price and numItem from the text fields
        String price = priceController.text;
        String numItem = numItemController.text;

        var res = await http.post(Uri.parse(uri), body: {
          "name": name.text,
          "price": price,
          "numItem": numItem, // Include numItem in the request
        });

        var response = jsonDecode(res.body);

        if (response["success"] == "true") {
          print("Record Inserted");
          name.text = "";
          priceController.text = ""; // Clear the price field
          numItemController.text = ""; // Clear the numItem field
          getrecord();
        } else {
          print("Some issue");
        }
      } catch (e) {
        print(e);
      }
    } else {
      print("Please Fill the Field");
    }
  }

  Future<void> openUpdateDialog(String existingName, int recordID,
      String existingPrice, String existingNumItem) async {
    name.text = existingName;
    priceController.text = existingPrice;
    numItemController.text = existingNumItem;

    double dialogWidth = MediaQuery.of(context).size.width * 0.8;

    await showDialog(
      context: context,
      builder: (context) => _buildUpdateDialog(recordID, dialogWidth),
    );
  }

  Widget _buildUpdateDialog(int recordID, double dialogWidth) {
    return AlertDialog(
      title: Text("Update Record"),
      content: Container(
        width: dialogWidth,
        child: Padding(
          padding: const EdgeInsets.all(12.0),
          child: Column(
            mainAxisSize: MainAxisSize.min, // Set to min to wrap content
            children: [
              _buildTextFormField(name, "Enter Name"),
              SizedBox(height: 10),
              _buildTextFormField(priceController, "Enter Price"),
              SizedBox(height: 10),
              _buildTextFormField(numItemController, "Enter NumItem"),
            ],
          ),
        ),
      ),
      contentPadding: EdgeInsets.zero, // Remove default padding
      actions: [
        TextButton(
          child: Text('Update'),
          onPressed: () async {
            await updateRecord(recordID);
            Navigator.pop(context);
          },
        )
      ],
    );
  }

  Widget _buildTextFormField(TextEditingController controller, String labelText) {
    return TextFormField(
      controller: controller,
      decoration: InputDecoration(
        border: OutlineInputBorder(),
        labelText: labelText,
      ),
    );
  }


  // Function to update record
  Future<void> updateRecord(int recordID) async {
    if (name.text != "" && priceController.text != "" &&
        numItemController.text != "") {
      try {
        String uri = "http://127.0.0.1/Finals/update.php";

        var res = await http.post(Uri.parse(uri), body: {
          "id": recordID.toString(),
          "name": name.text,
          "price": priceController.text,
          "numItem": numItemController.text,
        });

        var response = jsonDecode(res.body);

        if (response["success"] == "true") {
          print("Record Updated");
          name.text = "";
          priceController.text = "";
          numItemController.text = "";
          // Refresh the data after updating
          getrecord();
        } else {
          print("Some issue");
        }
      } catch (e) {
        print(e);
      }
    } else {
      print("Please fill all the fields");
    }
  }

  Future<void> deleteRecord(int recordID) async {
    bool confirmDelete = await showDialog(
      context: context,
      builder: (context) =>
          AlertDialog(
            title: Text("Confirm Delete"),
            content: Text("Do you want to delete this record?"),
            actions: [
              TextButton(
                child: Text('No'),
                onPressed: () {
                  Navigator.of(context).pop(false);
                },
              ),
              TextButton(
                child: Text('Yes'),
                onPressed: () {
                  Navigator.of(context).pop(true);
                },
              ),
            ],
          ),
    );

    if (confirmDelete == true) {
      try {
        String uri = "http://127.0.0.1/Finals/delete.php";

        var res =
        await http.post(Uri.parse(uri), body: {"id": recordID.toString()});

        var response = jsonDecode(res.body);

        if (response["success"] == "true") {
          print("Record Deleted");
          // Refresh the data after deleting
          getrecord();
        } else {
          print("some issue");
        }
      } catch (e) {
        print(e);
      }
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
    return Padding(
      padding: const EdgeInsets.only(top: 20.0),
      child: Scaffold(
        appBar: AppBar(
          title: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                "List of Products",
                style: TextStyle(
                  fontSize: 24,
                ),
              ),
              Text(
                "Explore our amazing products",
                style: TextStyle(
                  fontSize: 16,
                  color: Colors.grey,
                ),
              ),
            ],
          ),
        ),
        body: Column(
          children: [
            Expanded(
              child: Padding(
                padding: const EdgeInsets.only(top: 12.0),
                child: ListView.builder(
                  itemCount: userdata.length,
                  itemBuilder: (context, index) {
                    return Card(
                      margin: EdgeInsets.all(10),
                      child: ListTile(
                        title: Row(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            // Left side (Product ID, Name, and NumItem)
                            Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                RichText(
                                  text: TextSpan(
                                    children: [
                                      TextSpan(
                                        text: 'Product #: ',
                                        style: TextStyle(
                                          color: Colors.black,
                                          // Match the color of CRUD buttons
                                          fontSize: 18,
                                        ),
                                      ),
                                      TextSpan(
                                        text: '51235123${userdata[index]['ID']}',
                                        style: TextStyle(
                                          color: Theme
                                              .of(context)
                                              .primaryColor,
                                          // Match the color of CRUD buttons
                                          fontSize: 18,
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                                Container(
                                  margin: EdgeInsets.only(top: 5),
                                  // Add margin to the product name
                                  child: Text(
                                    'Product Name: ${userdata[index]['name']}',
                                    style: TextStyle(
                                      color: Colors.black,
                                      fontSize: 12,
                                    ),
                                  ),
                                ),
                              ],
                            ),
                            // Spacer between left and right side
                            Spacer(),
                            // Right side (Price)
                            Text(
                              '₱${userdata[index]['price']}.00',
                              style: TextStyle(
                                fontSize: 21,
                                fontWeight: FontWeight.bold,
                                color: Colors.black,
                              ),
                            ),
                          ],
                        ),
                        // Align NumItem and CRUD icons
                        subtitle: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            // NumItem
                            Text(
                              'Items Left: ${userdata[index]['numItem']}',
                              style: TextStyle(
                                color: Colors.black,
                                fontSize: 12,
                              ),
                            ),
                            // CRUD actions
                            Row(
                              children: [
                                // Edit button
                                ElevatedButton(
                                  onPressed: () {
                                    openUpdateDialog(
                                      userdata[index]['name'],
                                      int.parse(userdata[index]['ID']),
                                      userdata[index]['price'],
                                      userdata[index]['numItem'],
                                    );
                                  },
                                  style: ElevatedButton.styleFrom(
                                    primary: Theme
                                        .of(context)
                                        .primaryColor,
                                    // Use the primary color from the theme
                                    onPrimary: Colors.white,
                                    // Text color on the button
                                    padding: EdgeInsets.symmetric(
                                        horizontal: 16),
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(8),
                                      side: BorderSide(color: Theme
                                          .of(context)
                                          .primaryColor), // Border color
                                    ),
                                  ),
                                  child: Icon(Icons.edit),
                                ),
                                SizedBox(width: 8),
                                // Add spacing between buttons
                                // Delete button
                                ElevatedButton(
                                  onPressed: () {
                                    // Call a function to delete the record
                                    deleteRecord(
                                        int.parse(userdata[index]['ID']));
                                  },
                                  style: ElevatedButton.styleFrom(
                                    primary: Theme
                                        .of(context)
                                        .primaryColor,
                                    // Use the primary color from the theme
                                    onPrimary: Colors.white,
                                    // Text color on the button
                                    padding: EdgeInsets.symmetric(
                                        horizontal: 16),
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(8),
                                      side: BorderSide(color: Theme
                                          .of(context)
                                          .primaryColor), // Border color
                                    ),
                                  ),
                                  child: Icon(Icons.delete),
                                ),
                              ],
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                ),
              ),
            ),
          ],
        ),
        floatingActionButton: FloatingActionButton(
          onPressed: () {
            openDialog();
          },
          tooltip: 'Add Product',
          child: Icon(Icons.add),
        ),
        floatingActionButtonLocation: FloatingActionButtonLocation.endFloat,
      ),
    );
  }

  Future openDialog() =>
      showDialog(
        context: context,
        builder: (context) =>
            AlertDialog(
              title: Text("Product"),
              content: SingleChildScrollView(
                child: Container(
                  width: MediaQuery
                      .of(context)
                      .size
                      .width * 0.8, // Adjust the width as needed
                  child: Column(
                    children: [
                      TextFormField(
                        controller: name,
                        decoration: InputDecoration(
                          border: OutlineInputBorder(),
                          labelText: "Enter Name of Product",
                        ),
                      ),
                      SizedBox(height: 10),
                      TextFormField(
                        controller: priceController,
                        decoration: InputDecoration(
                          border: OutlineInputBorder(),
                          labelText: "Enter the Price",
                        ),
                      ),
                      SizedBox(height: 10),
                      TextFormField(
                        controller: numItemController,
                        decoration: InputDecoration(
                          border: OutlineInputBorder(),
                          labelText: "NumItem",
                        ),
                      ),
                    ],
                  ),
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
              title: Text('Order #${userdata[index]['ID']}'),
              subtitle: Text('${userdata[index]['name']} - ${userdata[index]['price']} PHP'),
            ),
          );
        },
      ),
    );
  }
}
