import 'dart:convert';

import 'package:http/http.dart' as http;

import 'product_model.dart';

class ApiService {
  static const String baseUrl =
      'https://web-lanjut-production-3e01.up.railway.app/api';

  static Future<List<Product>> getProducts() async {
    try {
      final response = await http.get(Uri.parse('$baseUrl/products'));

      if (response.statusCode == 200) {
        final decodedData = jsonDecode(response.body);

        // Cek apakah data dibungkus di dalam Map (misal key 'data' atau langsung list)
        List<dynamic> body;
        if (decodedData is Map<String, dynamic>) {
          // Jika Laravel mengembalikan format paginasi atau dibungkus key 'data'
          body = decodedData['data'] ?? decodedData['products'] ?? [];
        } else if (decodedData is List) {
          body = decodedData;
        } else {
          body = [];
        }

        List<Product> products = body
            .map((item) => Product.fromJson(item))
            .toList();
        return products;
      } else {
        throw Exception(
          'Gagal memuat data produk (Code: ${response.statusCode})',
        );
      }
    } catch (e) {
      throw Exception('Error: $e');
    }
  }
}
