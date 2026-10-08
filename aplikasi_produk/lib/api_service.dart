import 'dart:convert';

import 'package:http/http.dart' as http;

import 'product_model.dart';

class ApiService {
  static const String baseUrl =
      'https://web-lanjut-production-3e01.up.railway.app/api';

  // Fungsi GET untuk mengambil data produk
  static Future<List<Product>> getProducts() async {
    try {
      final response = await http.get(Uri.parse('$baseUrl/products'));

      if (response.statusCode == 200) {
        List<dynamic> body = jsonDecode(response.body);
        List<Product> products = body
            .map((item) => Product.fromJson(item))
            .toList();
        return products;
      } else {
        throw Exception('Gagal memuat data produk');
      }
    } catch (e) {
      throw Exception('Error: $e');
    }
  }
}
