const calculator = (operator, ...numbers) => {
    if (numbers.length === 0) return "Masukkan angka!";
    
    switch (operator) {
        case '+':
            return numbers.reduce((a, b) => a + b);
        case '-':
            return numbers.reduce((a, b) => a - b);
        case '*':
            return numbers.reduce((a, b) => a * b);
        case '/':
            return numbers.reduce((a, b) => (b !== 0 ? a / b : "Error: Pembagian oleh nol!"));
        case '%':
            return numbers.reduce((a, b) => a % b);
        default:
            return "Operator tidak valid!";
    }
};

// Contoh Penggunaan
console.log("Hasil Penjumlahan:", calculator('+', 21, 7, 88));
console.log("Hasil Pengurangan:", calculator('-', 55, 13, 9));
console.log("Hasil Perkalian:", calculator('*', 77, 4, 12));
console.log("Hasil Pembagian:", calculator('/', 121, 5));
console.log("Hasil Modulus:", calculator('%', 98, 15));