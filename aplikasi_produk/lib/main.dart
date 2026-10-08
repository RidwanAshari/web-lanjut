import 'package:flutter/material.dart';

import 'add_product_screen.dart'; // Import halaman form tambah produk
import 'api_service.dart';
import 'product_model.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Aplikasi Produk',
      theme: ThemeData(primarySwatch: Colors.blue),
      home: const ProductScreen(),
    );
  }
}

class ProductScreen extends StatefulWidget {
  const ProductScreen({super.key});

  @override
  State<ProductScreen> createState() => _ProductScreenState();
}

class _ProductScreenState extends State<ProductScreen> {
  late Future<List<Product>> futureProducts;

  @override
  void initState() {
    super.initState();
    futureProducts = ApiService.getProducts();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Daftar Produk Railway')),
      body: FutureBuilder<List<Product>>(
        future: futureProducts,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Terjadi kesalahan: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('Tidak ada data produk.'));
          }

          final products = snapshot.data!;
          return ListView.builder(
            itemCount: products.length,
            itemBuilder: (context, index) {
              final product = products[index];
              return ListTile(
                leading: CircleAvatar(child: Text(product.id.toString())),
                title: Text(product.name),
                subtitle: Text('Harga: Rp ${product.price}'),
              );
            },
          );
        },
      ),
      // Tombol tambah produk di pojok kanan bawah
      floatingActionButton: FloatingActionButton(
        onPressed: () async {
          // Buka halaman AddProductScreen dan tunggu hasilnya
          final result = await Navigator.push(
            context,
            MaterialPageRoute(builder: (context) => const AddProductScreen()),
          );

          // Jika produk berhasil disimpan, refresh ulang daftar produk
          if (result == true) {
            setState(() {
              futureProducts = ApiService.getProducts();
            });
          }
        },
        child: const Icon(Icons.add),
      ),
    );
  }
}
