<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ?php include 'assets/inc/header.php';?> -->

    <!-- header -->
    @include('common.home_header')
    <!-- ********|| RIGHT PART START ||******** -->

    <div class="col-lg-9 col-md-7 p-0">
        <div class="right-body">
            <!-- ********|| BANNER PART START ||******** -->
            <section class="history-banner">
                <img class="img-fluid" src="{{ asset('img/history/history-banner.jpg') }}" alt="" />
            </section>
            <!-- ********|| BANNER PART END ||******** -->

            <!-- ********|| ADVISE START ||******** -->
            <section class="history-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title">
                                    HISTORY
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="history-inner">
                                @foreach($contentPages->where("title","History") as $contentPage)
                                <div class="history-content">

                                    {{$contentPage->excerpt}}
                                    <!-- In the city of Calcutta, then just over a hundred years old and growing fast both in
                                    commercial and political significance, the British Raj was busy setting its roots.
                                    And sports were definitely a part of the social lore. -->
                                </div>

                                @endforeach
                                <!-- <div class="history-content">
                                    Indeed, sports events were reckoned to be important enough for sub-continental
                                    reporters. Fortunately, a copy of the Madras Courier dated 23rd. February, 1792 has
                                    survived. The paper reported cricket fixtures between the Calcutta Cricket Club and
                                    Barrackpore and the Calcutta Cricket Club and Dum Dum. Clearly, the Calcutta Cricket
                                    Club was already in existence in 1792.
                                </div> -->
                                <!-- <div class="history-content">
                                    The story of how CC&FC traced its origins is interesting and is preserved in its
                                    archives thanks to Past President H.J. Moorhouse. It began in 1955 with a letter to
                                    The Times, London from Alan R. Tait, Honorary Secretary of Oporto Cricket Club in
                                    Portugal. The Club was celebrating its centenary that year, and Tait claimed that it
                                    'must be one of the oldest cricket club outside Great Britain'.
                                </div> -->
                                <!-- <div class="history-content">
                                    This letter drew a good deal of response from several quarters. Several clubs were
                                    identified as being older than Oporto. To use a cricketing metaphor, the ball swung
                                    in Calcutta's favour when one Irwing Rosenwater wrote to the Times about the news
                                    item in the Madras Courier dated 23rd. February, 1792, mentioned above.
                                </div> -->
                                <!-- <div class="history-content">
                                    In the absence of a permanent venue, the Calcutta Cricket Club played its games on
                                    the esplanade, parallel with the river Hooghly, between Fort William and Government
                                    House. By the 1820s, the members felt the need for a permanent ground. In 1825, the
                                    Calcutta Cricket Club managed to obtain the use of a plot of land on the Maidan as
                                    shown in the accompanying reproduction of the 'Sketch of the Maidan'. In 1841 the
                                    Club was allowed to enclose the ground by putting a fence around it. The Army,
                                    garrisoned at Fort William, however saw the Club as an encroacher and was extremely
                                    suspicious of its alleged motives! They complained to the Chief Magistrate and as a
                                    result the Club was relocated to the eastern boundary of the Auckland Circus
                                    Gardens.
                                </div> -->
                                <!-- <div class="history-content">
                                    Good times were not to last. In 1862, the Brigadier General Commanding Presidency
                                    Division wrote to the Quarter Master General that 'open space is preserved, as a
                                    general rule around forts as a Military precaution. And in 1864 the Club members
                                    found that a new road was being constructed which would 'cut directly through the
                                    ground and pass within a few yards of that portion of it on which the match wickets
                                    are invariably pitched'
                                </div> -->
                                <!-- <div class="history-content">
                                    The Club's 'prayer' to the Governor General was rejected and it had to partially
                                    relocate to the ground on the eastern end of Eden Gardens, the current location of
                                    the test venue. The Club made several representations asking for permission to
                                    'erect a suitable pavilion in the place of the wretched hut now in use'. Finally on
                                    19 April the long awaited approval arrived. A handsome and well built pavilion
                                    measuring 125 ft by 25 ft was promptly constructed out of the finest teak brought
                                    from Burma. It even had a 'Long Room' on the lines of the MCC pavilion at Lords. The
                                    pavilion no longer exists. It was pulled in the mid 1970s for the construction of
                                    the Cricket Association of Bengal's modern B.C. Roy Clubhouse.
                                </div> -->
                                <!-- <div class="history-content">
                                    The origin of the Ballgunge Cricket Club is a matter of some speculation. Possibly
                                    the uncertainties regarding playing cricket at Eden Gardens in the 1850s and early
                                    1860s led the players to form a separate Club in what was then a southern, civilian
                                    suburb of the city in 1864.
                                </div> -->
                                <!-- <div class="history-content">
                                    Ballygunge Cricket Club had some illustrious members. J.D. Guise (1872-1953) played
                                    for India and MCC. Around the turn of the twentieth century, E.C. Cowdery and A.S.
                                    Cowdrey played for the Club regularly. EC was the grandfather of Sir Colin Cowdrey,
                                    England Captain and batsman, who was born in Bangalore.
                                </div> -->
                                <!-- <div class="history-content">
                                    In the 1901-02 season there is interesting mention the unusual sport of Bicycle Polo
                                    a game now known as Cycle Polo, that is still played at CC&FC.
                                </div> -->
                                <!-- <div class="history-content">
                                    India found a place on the 'international' cricket map for the first time in 1889-90
                                    when, at the invitation of the Calcutta Cricket Club, the first ever tour of an
                                    English Cricket team, led by G.F. Vernon of Middlesex and composed entirely of
                                    amateurs took place. The first official MCC tour of India was on, thanks entirely to
                                    the initiative of the Calcutta Cricket Club. Moreover, MCC was to be skippered by
                                    Arthur Gilligan, the Sussex and England Captain, who was then at the height of his
                                    fame.
                                </div> -->
                                <!-- <div class="history-content">
                                    These tours were also directly responsible for the formation of the Board of Control
                                    of Cricket in India and paved the way for India to gain Test status. Subsequently
                                    the Cricket Association of Bengal had also been formed. Dr. B.C. Roy, elected of
                                    Chief Minister of West Bengal in 1948 felt that in independent India Eden Gardens
                                    ought to be the 'rightful' home of the State's cricket headquarters.
                                </div> -->
                                <!-- <div class="history-content">
                                    On Independence Day in 1950, T.C. Longfield, President, Calcutta Cricket Club handed
                                    over Eden Gardens to the newly formed National Cricket Club. T.C. Longfield had led
                                    Bengal when they won the Ranji Trophy for the first time in 1939.
                                </div> -->
                                <!-- <div class="history-content">
                                    In another fine gesture, Ballygunge Cricket Club, in deference to Calcutta Cricket
                                    Club, being an older Club, agreed to dissolve itself, after having transferred its
                                    lease on the Ballygunge ground to Calcutta Cricket Club. Ballygunge Cricket Club
                                    ceased to exist but its traditions remained.
                                </div> -->
                                <!-- <div class="history-content">
                                    The Calcutta Football Club, founded in 1872, is the oldest surviving rugby club in
                                    the world outside the United Kingdom. Why "football"? At that time, in Britain,
                                    rugby and football was synonymous. Interestingly, the Scottish Football Union,
                                    formed in 1873, did not alter its name to become the Scottish Rugby Union until
                                    1924.
                                </div> -->
                                <!-- <div class="history-content">
                                    By January 1873 as many as 137 members had enrolled. Probably the attraction of a
                                    bar that was free to members had something to do with its popularity! Rugby,
                                    however, suffered because of the departure of some of the regiments that had kept
                                    the game going. By 1877, because of the lack of players the remaining members
                                    decided to wind up the Club. Under the stewardship of Captain, Honorary Secretary
                                    and Treasurer, G A James Rothney, the Committee decided to donate a trophy made of
                                    ornate Indian workmanship to the Rugby Football Union from the available Club funds
                                    amounting to pounds 60 sterling. The offer was accepted and even today, every year,
                                    England and Scotland play an international rugby match for the "Calcutta Cup".
                                </div> -->
                                <!-- <div class="history-content">
                                    In May 1884, G A James Rothney called a meeting and decided to restart the club
                                    because of the arrival of "excellent football material" which had come along with a
                                    few regiments. Rugby began in all earnestness and in 1890 the Calcutta Rugby Union
                                    Challenge Cup Tournament was inaugurated. A fine silver cup, promptly christened
                                    "Calcutta Cup" - was presented by past C F C Presidents. The tournament is played
                                    even today on the CCFC ground.
                                </div> -->
                                <!-- <div class="history-content">
                                    The revival of the Calcutta Football Club in 1884 coincided with a renewed
                                    enthusiasm for soccer amongst Calcutta's expatriates. Three more European football
                                    clubs were formed between 1884 and 1889, along with a host of Indian football clubs.
                                </div> -->
                                <!-- <div class="history-content">
                                    Although Calcutta Football Club stayed away from Trades Cup, the country's first
                                    open football tournament because members felt that their " enjoyment of the sport
                                    would be impaired if they join the competitive fray", it was instrumental in
                                    instituting the Indian Football Association (IFA) in Calcutta very much on London
                                    lines.
                                </div>
                                <div class="history-content">
                                    In the initial years of the IFA Shield, CFC had a very creditable record. In 1950
                                    CFC was relegated. Declining membership also took its toll. On 14 May, 1963 CFC
                                    partially relinquished its exclusive rights on the Maidan tent and playing field in
                                    favour of Mohun Bagan Club and like Calcutta Cricket Club moved to Ballygunge.
                                </div>
                                <div class="history-content">
                                    In 1965, it merged with the Calcutta Cricket Club already established there and the
                                    Calcutta Cricket and Football Club came into being.
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-3">
                            @foreach($galleries->where("id","3") as $key => $gallery)

                            @foreach($gallery->images as $key => $media)
                            <div class="history-img">
                                <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
                            </div>
                            @endforeach
                            @endforeach
                            <!-- <div class="history-img">
                                <img class="img-fluid" src="{{ asset('img/history/history-sub-2.jpg') }}" alt="" />
                            </div>
                            <div class="history-img">
                                <img class="img-fluid" src="{{ asset('img/history/history-sub-3.jpg') }}" alt="" />
                            </div>
                            <div class="history-img">
                                <img class="img-fluid" src="{{ asset('img/history/history-sub-4.jpg') }}" alt="" />
                            </div>
                            <div class="history-img">
                                <img class="img-fluid" src="{{ asset('img/history/history-sub-5.jpg') }}" alt="" />
                            </div> -->
                        </div>

                    </div>
                </div>
            </section>
            <!-- ********|| ADVISE END ||******** -->



            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>