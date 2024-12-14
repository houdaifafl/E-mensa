@extends('examples.layout.m4_Werbeseite_layout')
@section('Header')
    <br>
        <div id="grid-template">
        <span><img src="/img/mensalogo.jpg" alt="logo" class="mensa_logo"></span>
        <span class="ober">
            <span><a href="#ankündigung" class="attribute">Ankündigung</a></span>
            &emsp;
            &nbsp;
            <span><a href="#speisen" class="attribute">Speisen</a></span>
            &emsp;
            &nbsp;
            <span><a href="#bezahlen" class="attribute">Zahlen</a></span>
            &emsp;
            &nbsp;
            <span><a href="#kontakt" class="attribute">Kontakt</a></span>
            &emsp;
            &nbsp;
            <span><a href="#wichtig" class="attribute">Wichtig fur uns</a></span>
        </span>
        <span>
        @if($_SESSION['Anmeldung ok']==false)
            <button class="button" onclick="window.location.href='/anmeldung'">Anmeldung</button>
        @else
            <button class="button" onclick="window.location.href='/abmeldung'">Abmeldung</button>
        @endif
        </span>
        </div>
    <hr>
@endsection

@section('angemeldet_als')
    <?php if(isset($_SESSION['name']))echo "Angemeldet als ". $_SESSION['name']; ?>
@endsection
@section('Beg')
    <div class="content">
        <div id="mensaphoto">
            <img src="/img/mensa.jpg" alt="mensa">
        </div>
        <div>
            <h2 id="ankündigung">Bald gibt es Essen auch online :)</h2>
            <p class="text1">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
                Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.
                Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus,
                sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
                Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales
                sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>
        </div>
        <br>
        <div>
            <h2 id="speisen">Köstlichkeiten, die Sie erwarten</h2>
            <table>
                @if(!empty($data))
                    <table>
                        <thead>
                        <tr>
                            <td>Gericht</td>
                            <th>Preis intern</th>
                            <th>Preis extern</th>
                            <th>Allergien</th>
                            <th>Bild</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $meal)
                            <tr>
                                <td>{{ $meal['name'] }}</td>
                                <td>{{ $meal['preis_intern'] }}€</td>
                                <td>{{ $meal['preis_extern'] }}€</td>
                                <td>{{ $meal['Allergien'] }}</td>
                                <td><img class = "bildd" src="/img/gerichte/{{ $meal['bildname'] }}"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Es sind keine Gerichte vorhanden</p>
            @endif
        </div>
    </div>
@endsection
@section('Info')
    <div class="content">
      <div>
           <h2>Intersse geweckt? wir informieren Sie!</h2>
           <form action="Newsletteranmeldung.php" method="post">
            <label for="vorname">Ihr Name:</label>
            <label for="email" class="mail">Ihre E-Mail:</label>
            <label for="newsletter" class="news">Newsletter bitte in:</label>
            <br>
            <input type="text" id="vorname" name="Vorname" placeholder="Vorname">
            <input type="text" id="email" name="Email" placeholder="Email">
            <select  id="newsletter">
                <option value="English">English</option>
                <option value="Deutsch" selected>Deutsch</option>
                <option value="Arabic">Arabic</option>
            </select>
            <br>
            <input type="checkbox" name="datenschutz" id="daten">
            <label for="daten">Den Datenschutzbestimmungen stimme ich zu</label>
            <input type="submit" name="anmelden" value="Zum Newsletter anmelden" id="sub">
           </form>
           <br>
           </form>
      </div>

      <div>
        <h2 id="wichtig">Das ist uns wichtig</h2>
        <ul id="lastlist">
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
      </div>
    </div>

@endsection

@section('Ende')
    <br>
    <h2 class="end">Wir freuen uns auf Ihre Besuch</h2>
@endsection
@section('fotter')
    <hr>
    <footer id="kontakt">
        <p class="n1"> &copy; E-Mensa GmbH | Houdaifa Fakih Lanjri | <a href=" " class="Impress"> Impressum </a></p>
    </footer>
@endsection
