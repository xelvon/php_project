<?php

/*
 1. Sprawdzenie, czy znak jest liczbą
    public static boolean isNumber(char znak){
        return (znak >= '0' && znak <= '9');
    }
 
 2. Czytanie pliku znak po znaku (funkcja mnoz z kolokwium Javy)
    public long mnoz(String nazwa, int kolumna) throws WyjatekMnozenia{
        long wynik = 1;
        try {
            Scanner sc2 = new Scanner(new File(nazwa));
            int wiersz = 1;
            char znak;
            
            while (sc2.hasNextLine()) {
                    Scanner s2 = new Scanner(sc2.nextLine());
                while (s2.hasNext()) {
                    String linijka = s2.next();
                    for (int index = 0; index < linijka.length();index++) {
                        znak = linijka.charAt(index);
                        if(isNumber(znak)){
                            if(index == kolumna && znak == '2'){
                                wynik *= Character.getNumericValue(znak);
                            }
                        }else{
                            throw new WyjatekMnozenia(linijka,wiersz);
                        }
                    }
                    wiersz++;
                }
            }
        } catch (FileNotFoundException e) {
            System.out.println("File "+nazwa+" not found");
        }
        
        return wynik;
    }
 3. Przykladowy wątek
    public class WatekMnozacy extends Thread{
        private final String nazwa;
        private final int kolumna;
        private final MnoznikInterface mnoznik;
        private final Wynik wynik;

        public WatekMnozacy(String _plik, int _kolumna, MnoznikInterface _mi, Wynik _w){
            nazwa = _plik;
            kolumna = _kolumna;
            mnoznik = _mi;
            wynik = _w;
        }

        @Override
        public void run() {
            try{
                wynik.setWynik(mnoznik.mnoz(nazwa, kolumna));
            }catch(WyjatekMnozenia e){}
        }
    }
4. Przykladowy wyjatek
    public class WyjatekMnozenia extends Exception {
        private final String tekst;
        private final int nr_linijki;

        public WyjatekMnozenia(String linia, int wiersz){
            tekst = linia;
            nr_linijki = wiersz;
            System.out.println("Błąd mnozenia w "+linia+" kolumna nr "+wiersz);
        }

        public String getLine(){
            return tekst;
        }

        public int getLineNo(){
            return nr_linijki;
        }
    }
 */