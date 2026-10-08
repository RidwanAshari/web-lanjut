import 'package:flutter/material.dart';

import 'api_service.dart';

class AddProductScreen extends StatefulWidget {
  const AddProductScreen({super.key});

  @override
  State<AddProductScreen> createState() => _AddProductScreenState();
}

class _AddProductScreenState extends State<AddProductScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nameController = TextEditingController();
  final _priceController = TextEditingController();
  final _stockController = TextEditingController(text: '10'); // Default stok 10
  bool _isLoading = false;

  void _submitData() async {
    if (_formKey.currentState!.validate()) {
      setState(() => _isLoading = true);
      try {
        // Konversi aman ke int (menggunakan int.tryParse atau double.tryParse lalu diconvert ke int)
        final parsedStock =
            int.tryParse(_stockController.text) ??
            double.tryParse(_stockController.text)?.toInt() ??
            10;

        await ApiService.addProduct(
          _nameController.text,
          _priceController.text,
          stock: parsedStock,
        );

        // Jika berhasil, kembali ke halaman sebelumnya dan kirim sinyal 'true'
        if (mounted) {
          Navigator.pop(context, true);
        }
      } catch (e) {
        // Tampilkan alasan error dari server Laravel di SnackBar
        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text('$e'),
              backgroundColor: Colors.red,
              duration: const Duration(seconds: 4),
            ),
          );
        }
      } finally {
        if (mounted) {
          setState(() => _isLoading = false);
        }
      }
    }
  }

  @override
  void dispose() {
    _nameController.dispose();
    _priceController.dispose();
    _stockController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Tambah Produk Baru')),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              TextFormField(
                controller: _nameController,
                decoration: const InputDecoration(labelText: 'Nama Produk'),
                validator: (value) => value == null || value.isEmpty
                    ? 'Nama tidak boleh kosong'
                    : null,
              ),
              TextFormField(
                controller: _priceController,
                keyboardType: TextInputType.number,
                decoration: const InputDecoration(labelText: 'Harga Produk'),
                validator: (value) => value == null || value.isEmpty
                    ? 'Harga tidak boleh kosong'
                    : null,
              ),
              TextFormField(
                controller: _stockController,
                keyboardType: TextInputType.number,
                decoration: const InputDecoration(labelText: 'Stok Produk'),
                validator: (value) => value == null || value.isEmpty
                    ? 'Stok tidak boleh kosong'
                    : null,
              ),
              const SizedBox(height: 20),
              _isLoading
                  ? const CircularProgressIndicator()
                  : ElevatedButton(
                      onPressed: _submitData,
                      child: const Text('Simpan Produk'),
                    ),
            ],
          ),
        ),
      ),
    );
  }
}
