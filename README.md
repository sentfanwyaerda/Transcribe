### Roadmap
- 1) [ *100%* ] get the **player** operational, let **[tab]** pause and play, and [ *0%* ] let it load video/audio through URI (for ftp, web or local support)
- 2) [ *0%* ] get the **editor** to save your transcripts, including srt-files, and [ *100%* ] let the **player** send timestamps (when pressed **[shift][enter]**)
- 3) [ *0%* ] enable *cue zones* to synchronize scenes in your media with your transcript, through the timestamps and **[shift][up/down]**
- 4) [ *optional* ] optimize for an *auto-transcribe mode* with help of [Dragon Naturally Speaking](http://www.nuance.com/dragon/) ( *propriatory* ) on desktops running windows
- 5) [ *extra* ] introduce a view-mode: the **player** automatically skips to the next *cue zone* while playing the video

### Modules
- **player:** [Video.js](http://www.videojs.com/) on [GitHub](https://github.com/videojs/) (free, Apache2 license)
- **editor:** just a simple textarea and some javascript (for now)
- **browser:** [FSnode::FSbrowser](https://github.com/sentfanwyaerda/FSnode) (cc-by-nd)

### License
**[cc-by-nd](http://creativecommons.org/licenses/by-nd/4.0/)**: Distributed on an "AS IS" BASIS, WITHOUT WARRENTIES OR CONDITIONS OF ANY KIND.

### Documentation
**Transcribe** is mainly written in JavaScript, with an [PHP](http://php.net/) backbone for additional functionality. Its designed to use any type of player (for now only VideoJS), with its uniform set of functions to execute actions: *player_is_playing()*, *player_is_paused()*, *player_play()*, *player_pause()*, *player_timestamp()*, *player_press_play_paused(bool)*, *player_load(source)* and *player_goto(seconds)*. Additional the editor has its own set of functions: *set_timestamp()*, *add_timestamp()*. And uses *onEditorChange()* to hook keyboard actions like [tab] and [shift][enter].
