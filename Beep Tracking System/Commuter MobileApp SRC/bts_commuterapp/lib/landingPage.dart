import 'package:bts_commuterapp/login.dart';
import 'package:introduction_screen/introduction_screen.dart';
import 'package:flutter/material.dart';
  
class LandingPage extends StatelessWidget {
  const LandingPage({Key key}) : super(key: key);

  void _onIntroEnd(context) {
    Navigator.of(context).push(
      MaterialPageRoute(builder: (_) => Login()),
    );
  }

  @override
  Widget build(BuildContext context) {
    const bodyStyle = TextStyle(fontSize: 19.0);
    const pageDecoration = const PageDecoration(
      titleTextStyle: TextStyle(fontSize: 28.0, fontWeight: FontWeight.w700),
      bodyTextStyle: bodyStyle,
      descriptionPadding: EdgeInsets.fromLTRB(16.0, 0.0, 16.0, 16.0),
      pageColor: Colors.white,
      imagePadding: EdgeInsets.zero,
    );

    return IntroductionScreen(
      pages: [
        PageViewModel(
          title: "Welcome to \nBeep Tracking System",
          body: "",
          image: Image.asset('lib/assets/icon/BTSLogo.png'),
          decoration: pageDecoration,
        ),
        PageViewModel(
          title: "Tired of hailing?",
          body:
              "Instead of having to wait for the bus to check for available seats, \nBeep Tracking System tells you if incoming buses are vacant!",
          image: Image.asset('lib/assets/images/1st.jpg'),
          decoration: pageDecoration,
        ),
        PageViewModel(
          title: "Check the ETA!",
          body:
              "Beep Tracking System calculates the Estimated Time of Arrival (ETA) of buses approaching you!",
          image: Image.asset('lib/assets/images/2nd.jpg'),
          decoration: pageDecoration,
        ),
        PageViewModel(
          title: "How's our service?",
          body:
              "Voice out your concerns! \nWe would love to hear from you!",
          image: Image.asset('lib/assets/images/3rd.jpg'),
          decoration: pageDecoration,
        )
      ],
      onDone: () => _onIntroEnd(context),
      onSkip: () => _onIntroEnd(context), // You can override onSkip callback
      showSkipButton: true,
      skipFlex: 0,
      nextFlex: 0,
      skip: const Text('Skip'),
      next: const Icon(Icons.arrow_forward),
      done: const Text('Done', style: TextStyle(fontWeight: FontWeight.w600)),
      dotsDecorator: const DotsDecorator(
        size: Size(10.0, 10.0),
        color: Color(0xFFBDBDBD),
        activeSize: Size(22.0, 10.0),
        activeShape: RoundedRectangleBorder(
          borderRadius: BorderRadius.all(Radius.circular(25.0)),
        ),
      ),
    );
  }
}