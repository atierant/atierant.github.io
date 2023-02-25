let Vivus = require('vivus/dist/vivus');

(function headingTwin() {
    let $svgPath = $('#polygon-head path'),
        $textFade = $('h1 .text-fade'),
        v, textFadeWidth = [],
        textTwinFadeWidth = [],
        twinFillValue = 0;

    for (let i = 0; i < $textFade.length; i++) {
      const el = $textFade.get(i);
      textFadeWidth[i] = el.offsetWidth;
        textTwinFadeWidth[i] = 0;
    }

    $('h1').on('click', function () {
        $('#scene').click();
    });

    $svgPath.css('fill', 'none');
    $svgPath.css('stroke', '#FFFFFF');


    $textFade.css('display', 'inline-block');
    $textFade.css('overflow', 'hidden');
    $textFade.css('height', '53px');
    $textFade.css('width', '0px');

    v = new Vivus('polygon-head', {
        type: 'delayed',
        duration: 1000
    });

    v.reset().play();

    window.setTimeout(function twinFillCb() {
        $svgPath.css('stroke', 'transparent');
      let next = false;

      if (twinFillValue < 1) {
            twinFillValue += 1 / 24;
            $svgPath.css('stroke', 'rgba(255, 255, 255, ' + 1 - twinFillValue + ')');
            $svgPath.css('fill', 'rgba(255, 255, 255, ' + twinFillValue + ')');
            next = true;
        }

        for (let i = 0; i < $textFade.length; i++) {
            if (textTwinFadeWidth[i] < textFadeWidth[i]) {
                textTwinFadeWidth[i] += textFadeWidth[i] / 24;
                $($textFade.get(i)).css('width', textTwinFadeWidth[i] + 'px');
                next = true;
            }
        }


        if (next) {
            window.setTimeout(twinFillCb, 24);
        } else {
            $svgPath.css('stroke', 'rgba(255, 255, 255, 0)');
            $svgPath.css('fill', 'rgba(255, 255, 255, 1)');
        }
    }, 2700);
})();

(function coverHandler() {
    'use strict';
    // Adapt from the andrew tutorial : http://www.script-tutorials.com/demos/319/index2.html
    // enhance with some new effets
    // 3D polygon mesh technics : https://en.wikipedia.org/wiki/Polygon_mesh

  const cover = {
    nbFacesDrawn: 0,
    nbFacesDrawnStep: 0.3,
    nbStrokeDrawn: 0,
    nbStrokeDrawnStep: 0.4,

    maxStrokeLight: 40,
    maxTwStrokeLight: 0,
    strokeLight: 0,
    strokeEnlightenPoints: [],
    strokeEnlightenPointsOld: [],

    animationState: 1,

    startTime: null,
    obj: null,
    canvas: null,
    iHalfX: null,
    iHalfY: null,
    vAlpha: 0.4,
    vShiftX: 0,
    vShiftY: 0,
    distance: -1000,
    vMouseSens: 0.02,
    nbFaces: 6,
    distZ: null, // use for the dezoom effet
    theme: null,
    polygonComplexity: 10,
    width: 0,
    height: 0,
    themeArray: []
  };

  cover.themeArray.push({
        vAlpha: 0.15,
        distance: -600,
        scaleObjX: 3,
        scaleObjY: 3,
        scaleObjZ: 3,
        translate: -1000,
        colorsSelection: ['#173b6c', '#149ddd', '#7491b7', '#7E1F86'],
        lineWidth: 0.5,
        strokeStyle: ['rgb(23,59,108)']
    });

    // init the currentTheme to load (will be pushed to other builders)
  const currentTheme = Math.floor((Math.random() * cover.themeArray.length));
  cover.theme = cover.themeArray[currentTheme];

    // get random color
    function getRandomColor() {
        return cover.theme.colorsSelection[Math.floor(Math.random() * cover.theme.colorsSelection.length)];
    }

    // initialization
    function sceneInit() {
        window.requestAnimationFrame =
      window.requestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.msRequestAnimationFrame ||
      function (callback) {
          window.setTimeout(callback, 1000 / 60);
      };

      const getComputedSceneStyle = window.getComputedStyle(document.getElementById('scene'), null);

      if (typeof getComputedSceneStyle.getPropertyValue == 'function') {
            cover.width = getComputedSceneStyle.getPropertyValue('width');
            cover.width = cover.width.substring(0, cover.width.length - 2);
            cover.height = getComputedSceneStyle.getPropertyValue('height');
            cover.height = cover.height.substring(0, cover.height.length - 2);
        } else if (typeof getComputedSceneStyle.getPropertyCSSValue == 'function') {
            cover.width = getComputedSceneStyle.getPropertyCSSValue('width').cssText;
            cover.width = cover.width.substring(0, cover.width.length - 2);
            cover.height = getComputedSceneStyle.getPropertyCSSValue('height').cssText;
            cover.height = cover.height.substring(0, cover.height.length - 2);
        } else {
            cover.width = cover.canvas.width;
            cover.height = cover.canvas.height;
        }

        // prepare canvas and context objects
        cover.canvas = document.getElementById('scene');
        cover.ctx = cover.canvas.getContext('2d');

        cover.iHalfX = cover.canvas.width / 2;
        cover.iHalfY = cover.canvas.height / 2;

        switchPolygon();

        cover.canvas.onmousemove = handleMousemove;
        cover.canvas.onclick = handleClick;

        cover.vShiftX = 0.002;
        cover.vShiftY = -0.003;

        cover.startTime = (new Date()).getTime();
        window.requestAnimationFrame(drawScene);
    }

    function switchPolygon() {
        cover.canvas = document.getElementById('scene');
        cover.ctx = cover.canvas.getContext('2d');

        // Dezoom effet start to
        cover.distZ = 1000;

        cover.obj = new Sphere(cover.polygonComplexity);
        scaleObj([cover.theme.scaleObjX, cover.theme.scaleObjY, cover.theme.scaleObjZ], cover.obj);
        translateObj([-cover.obj.center[0], -cover.obj.center[1], -cover.obj.center[2]], cover.obj);
        translateObj([0, 0, cover.theme.translate], cover.obj);

    }

    // onMouseMove event handler
    function handleMousemove(e) {
      const x = e.layerX - cover.canvas.offsetLeft;
      const y = e.layerY - cover.canvas.offsetTop;

      if ((x > 0) && (x < cover.width) && (y > 0) && (y < cover.height)) {
            cover.vShiftY = cover.vMouseSens * (x - cover.width / 2) / cover.width / 2;
            cover.vShiftX = cover.vMouseSens * (y - cover.height / 2) / cover.height / 2;
        }
    }

    function handleClick() {
        cover.animationState = 1;
        cover.nbFacesDrawn = 0;
        cover.nbStrokeDrawn = 0;
        cover.polygonComplexity += 2;
        cover.maxTwStrokeLight = 0;

        if (cover.polygonComplexity > 40) {
            cover.polygonComplexity = 10;
        }
        cover.nbFacesDrawnStep = 0.3 * ((cover.polygonComplexity - 10) + 1);
        cover.nbStrokeDrawnStep = 0.4 * ((cover.polygonComplexity - 10) + 1);

        if (cover.nbStrokeDrawnStep < 0) {
            cover.nbStrokeDrawnStep *= -1;
        }
        switchPolygon();
    }

    // draw main scene function
    function drawScene(startedSince) {
      let i, j, f, z;

      // clear canvas
        cover.ctx.clearRect(0, 0, cover.ctx.canvas.width, cover.ctx.canvas.height);
        cover.ctx.lineWidth = cover.theme.lineWidth;

        /*if (cover.animationState != 2) {
          cover.ctx.globalAlpha = cover.theme.vAlpha;
      }*/

        // vertical and horizontal rotate
      const vP1x = getRotationPar([0, 0, -1000], [1, 0, 0], cover.vShiftX);
      const vP2x = getRotationPar([0, 0, 0], [1, 0, 0], cover.vShiftX);
      const vP1y = getRotationPar([0, 0, -1000], [0, 1, 0], cover.vShiftY);
      const vP2y = getRotationPar([0, 0, 0], [0, 1, 0], cover.vShiftY);
      rotateObj(vP1x, vP2x, cover.obj);
        rotateObj(vP1y, vP2y, cover.obj);

        // recalculate distances
        for (i = 0; i < cover.obj.points_number; i++) {
            cover.obj.distances[i] = Math.pow(cover.obj.points[i][0], 2) + Math.pow(cover.obj.points[i][1], 2) + Math.pow(cover.obj.points[i][2], 2);
        }

        // prepare array with face triangles (with calculation of max distance for every face)
      let iCnt = 0;
      const aFaceTriangles = [];
      for (i = 0; i < cover.obj.faces_number; i++) {
          let max = cover.obj.distances[cover.obj.faces[i][0]];
          for (f = 1; f < cover.obj.faces[i].length; f++) {
                if (cover.obj.distances[cover.obj.faces[i][f]] > max)
                    max = cover.obj.distances[cover.obj.faces[i][f]];
            }
            aFaceTriangles[iCnt++] = {
                faceVertex: cover.obj.faces[i],
                faceColor: cover.obj.colors[i],
                distance: max
            };
        }
        aFaceTriangles.sort(sortByDistance);

        // prepare array with projected points
      const aPrjPoints = [];

      /*if (Math.round(cover.distZ) != 0) {
        cover.distZ = cover.distZ / 1.1;
    }*/

        for (i = 0; i < cover.obj.points.length; i++) {
            aPrjPoints[i] = project(cover.theme.distance, cover.obj.points[i], cover.iHalfX, cover.iHalfY);
        }

        cover.ctx.strokeStyle = cover.theme.strokeStyle[0];


        /**
     * slow build/un-build elements (first stokes then faces)
     */
        if (cover.animationState == 1) {
            if (cover.nbStrokeDrawnStep > 0) {

                if (cover.nbStrokeDrawn < iCnt && cover.nbFacesDrawn < iCnt) {
                    cover.nbStrokeDrawn += cover.nbStrokeDrawnStep;
                }

                if (cover.nbStrokeDrawn > iCnt/*(iCnt / 6 * 5)*/) {

                    if (cover.nbFacesDrawn < iCnt) {
                        cover.nbFacesDrawn += cover.nbFacesDrawnStep;
                    } else {
                        cover.nbStrokeDrawnStep *= -1;
                    }
                }
            } else {
                cover.nbStrokeDrawn += cover.nbStrokeDrawnStep;

                if (cover.nbFacesDrawn >= iCnt && cover.nbStrokeDrawn <= 0) {
                    cover.animationState = 2;
                }
            }
        }


        /**
     * reset/rotate enlighten points
     */
        if (cover.animationState == 2) {
            cover.strokeLight = 0;

            if (cover.maxTwStrokeLight < cover.maxStrokeLight) {
                cover.maxTwStrokeLight += (cover.maxStrokeLight * 0.001);
            }


            if ((Math.round(startedSince) % 32) == 0) {
                cover.strokeEnlightenPointsOld.push(cover.strokeEnlightenPoints[0]);
                cover.strokeEnlightenPointsOld.push(cover.strokeEnlightenPoints[1]);
                cover.strokeEnlightenPoints.shift();
                cover.strokeEnlightenPoints.shift();
            }

            if ((Math.round(startedSince) % 64) == 0) {
                cover.strokeEnlightenPointsOld.shift();
            }
            if ((Math.round(startedSince) % 512) == 0) {
                cover.maxTwStrokeLight /= 2;
                cover.strokeEnlightenPointsOld = [];
            }
        }


        // draw an object (surfaces)
        for (i = 0; i < iCnt; i++) {

          const colorRGB = hexToRgb(aFaceTriangles[i].faceColor);
          cover.ctx.fillStyle = 'rgba(' + colorRGB.r + ', ' + colorRGB.g + ', ' + colorRGB.b + ', ' + cover.vAlpha + ')';

            // begin path
            cover.ctx.beginPath();

            // face vertex index
          const iFaceVertex = aFaceTriangles[i].faceVertex;

          // move to initial position
            cover.ctx.moveTo(aPrjPoints[iFaceVertex[0]][0], aPrjPoints[iFaceVertex[0]][1]);

            // and draw three lines (to build a triangle)
            for (z = 1; z < aFaceTriangles[i].faceVertex.length; z++) {
                cover.ctx.lineTo(aPrjPoints[iFaceVertex[z]][0], aPrjPoints[iFaceVertex[z]][1]);
            }

            // close path, strole and fill a triangle
            cover.ctx.closePath();


            /**
       * enlighten future components (strokes and faces)
       */
            if (cover.animationState == 1) {
                if (i < cover.nbFacesDrawn) {
                    cover.ctx.fill();
                } else if (i > 3 && i < (cover.nbFacesDrawn + 1)) {
                    cover.ctx.fillStyle = 'rgba(255, 255, 255, 0.2)';
                    cover.ctx.fill();
                }

                if (i < cover.nbStrokeDrawn) {
                    cover.ctx.strokeStyle = 'rgba(255, 255, 255, 0.15)';
                    cover.ctx.stroke();
                } else if (i > 3 && i < (cover.nbStrokeDrawn + 2)) {
                    cover.ctx.strokeStyle = 'rgba(255, 255, 255, 0.6)';
                    cover.ctx.stroke();
                }
            }


            /**
       * enlighten random strokes
       */
            if (cover.animationState == 2) {
                if (cover.strokeEnlightenPoints.length > 0
          && cover.strokeLight < cover.strokeEnlightenPoints.length
          && cover.strokeLight < cover.maxTwStrokeLight
                ) {
                    for (j = 0; j < cover.strokeEnlightenPoints.length; j++) {
                        if (cover.strokeEnlightenPoints[j] == iFaceVertex[0]) {
                            if (j == (cover.strokeEnlightenPoints.length - 1)) {
                                cover.ctx.strokeStyle = 'rgba(255, 255, 255, 1)';
                            } else if (j > (cover.strokeEnlightenPoints.length - 2)) {
                                cover.ctx.strokeStyle = 'rgba(255, 255, 255, 0.8)';
                            } else if (j > (cover.strokeEnlightenPoints.length - 4)) {
                                cover.ctx.strokeStyle = 'rgba(255, 255, 255, 0.7)';
                            } else {
                                cover.ctx.strokeStyle = 'rgba(255, 255, 255, 0.6)';
                            }
                            cover.strokeLight++;
                            cover.ctx.stroke();
                            break;
                        }
                    }
                } else if (cover.strokeLight < cover.maxTwStrokeLight
          && Math.round(Math.random() * (i / 3) * Math.PI) < 2
                ) {
                  let strokeValid = true;
                  for (j = 0; j < cover.strokeEnlightenPointsOld.length; j++) {
                        if (cover.strokeEnlightenPointsOld[j] == iFaceVertex[0]) {
                            strokeValid = false;
                            break;
                        }
                    }

                    if (strokeValid) {
                        cover.strokeEnlightenPoints.push(iFaceVertex[0]);
                    }
                }

                cover.ctx.fill();
            }
        }

        window.requestAnimationFrame(drawScene);
    }

    // prepare object
    function prepareObject(o) {
      let i;
      o.colors = [];

        // prepare normals
        o.normals = [];
        for (i = 0; i < o.faces.length; i++) {
            o.normals[i] = [0, 0, 0];

            o.colors[i] = getRandomColor();
        }

        // prepare centers: calculate max positions
        o.center = [0, 0, 0];
        for (i = 0; i < o.points.length; i++) {
            o.center[0] += o.points[i][0];
            o.center[1] += o.points[i][1];
            o.center[2] += o.points[i][2];
        }

        // prepare distances
        o.distances = [];
        for (i = 1; i < o.points.length; i++) {
            o.distances[i] = 0;
        }

        // calculate average center positions
        o.points_number = o.points.length;
        o.center[0] = o.center[0] / (o.points_number - 1);
        o.center[1] = o.center[1] / (o.points_number - 1);
        o.center[2] = o.center[2] / (o.points_number - 1);

        o.faces_number = o.faces.length;
        o.axis_x = [1, 0, 0];
        o.axis_y = [0, 1, 0];
        o.axis_z = [0, 0, 1];

    }

    // Sphere object
    function Sphere(n) {
      let i, j;
      const delta_angle = 2 * Math.PI / n;

      // prepare vertices (points) of sphere
      const vertices = [];
      for (j = 0; j < n / 2 - 1; j++) {
            for (i = 0; i < n; i++) {
                vertices[j * n + i] = [];
                vertices[j * n + i][0] = 100 * Math.sin((j + 1) * delta_angle) * Math.cos(i * delta_angle);
                vertices[j * n + i][1] = 100 * Math.cos((j + 1) * delta_angle);
                vertices[j * n + i][2] = 100 * Math.sin((j + 1) * delta_angle) * Math.sin(i * delta_angle);
            }
        }
        vertices[(n / 2 - 1) * n] = [];
        vertices[(n / 2 - 1) * n + 1] = [];

        vertices[(n / 2 - 1) * n][0] = 0;
        vertices[(n / 2 - 1) * n][1] = 100;
        vertices[(n / 2 - 1) * n][2] = 0;

        vertices[(n / 2 - 1) * n + 1][0] = 0;
        vertices[(n / 2 - 1) * n + 1][1] = -100;
        vertices[(n / 2 - 1) * n + 1][2] = 0;

        this.points = vertices;

        // prepare faces
      const faces = [];
      for (j = 0; j < n / 2 - 2; j++) {
            for (i = 0; i < n - 1; i++) {
                faces[j * 2 * n + i] = [];
                faces[j * 2 * n + i + n] = [];

                faces[j * 2 * n + i][0] = j * n + i;
                faces[j * 2 * n + i][1] = j * n + i + 1;
                faces[j * 2 * n + i][2] = (j + 1) * n + i + 1;
                faces[j * 2 * n + i + n][0] = j * n + i;
                faces[j * 2 * n + i + n][1] = (j + 1) * n + i + 1;
                faces[j * 2 * n + i + n][2] = (j + 1) * n + i;
            }

            faces[j * 2 * n + n - 1] = [];
            faces[2 * n * (j + 1) - 1] = [];

            faces[j * 2 * n + n - 1][0] = (j + 1) * n - 1;
            faces[j * 2 * n + n - 1][1] = (j + 1) * n;
            faces[j * 2 * n + n - 1][2] = j * n;
            faces[2 * n * (j + 1) - 1][0] = (j + 1) * n - 1;
            faces[2 * n * (j + 1) - 1][1] = j * n + n;
            faces[2 * n * (j + 1) - 1][2] = (j + 2) * n - 1;
        }
        for (i = 0; i < n - 1; i++) {
            faces[n * (n - 4) + i] = [];
            faces[n * (n - 3) + i] = [];

            faces[n * (n - 4) + i][0] = (n / 2 - 1) * n;
            faces[n * (n - 4) + i][1] = i;
            faces[n * (n - 4) + i][2] = i + 1;
            faces[n * (n - 3) + i][0] = (n / 2 - 1) * n + 1;
            faces[n * (n - 3) + i][1] = (n / 2 - 2) * n + i + 1;
            faces[n * (n - 3) + i][2] = (n / 2 - 2) * n + i;
        }

        faces[n * (n - 3) - 1] = [];
        faces[n * (n - 2) - 1] = [];

        faces[n * (n - 3) - 1][0] = (n / 2 - 1) * n;
        faces[n * (n - 3) - 1][1] = n - 1;
        faces[n * (n - 3) - 1][2] = 0;
        faces[n * (n - 2) - 1][0] = (n / 2 - 1) * n + 1;
        faces[n * (n - 2) - 1][1] = (n / 2 - 2) * n;
        faces[n * (n - 2) - 1][2] = (n / 2 - 2) * n + n - 1;

        this.faces = faces;

        prepareObject(this);
    }

    function getRotationPar(center, vector, t) {
      const result = [];

      const u_u = vector[0] * vector[0];
      const v_v = vector[1] * vector[1];
      const w_w = vector[2] * vector[2];

      const v_v_p_w_w = (v_v + w_w);
      const u_u_p_w_w = (u_u + w_w);
      const u_u_p_v_v = (u_u + v_v);

      const b_v_p_c_w = center[1] * vector[1] + center[2] * vector[2];
      const a_u_p_c_w = center[0] * vector[0] + center[2] * vector[2];
      const a_u_p_b_v = center[0] * vector[0] + center[1] * vector[1];
      const b_w_m_c_v = center[1] * vector[2] - center[2] * vector[1];
      const c_u_m_a_w = center[2] * vector[0] - center[0] * vector[2];
      const a_v_m_b_u = center[0] * vector[1] - center[1] * vector[0];

      const den = v_v + u_u + w_w;

      result[0] = den;

        result[1] = v_v_p_w_w;
        result[2] = u_u_p_w_w;
        result[3] = u_u_p_v_v;

        result[4] = center[0] * v_v_p_w_w;
        result[5] = center[1] * u_u_p_w_w;
        result[6] = center[2] * u_u_p_v_v;

        result[7] = b_v_p_c_w;
        result[8] = a_u_p_c_w;
        result[9] = a_u_p_b_v;

        result[10] = Math.cos(t);

        result[11] = Math.sin(t) * Math.sqrt(den);

        result[12] = b_w_m_c_v;
        result[13] = c_u_m_a_w;
        result[14] = a_v_m_b_u;

        result[15] = center[0];
        result[16] = center[1];
        result[17] = center[2];
        result[18] = vector[0];
        result[19] = vector[1];
        result[20] = vector[2];

        return result;
    }

    function rotate(p, point) {
      const p_20_p_2 = p[20] * point[2];
      const p_19_p_1 = p[19] * point[1];
      const p_18_p_0 = p[18] * point[0];
      const u_x_p_v_y_p_w_z = p_18_p_0 + p_19_p_1 + p_20_p_2;

      const temp0 = point[0];
      const temp1 = point[1];

      point[0] = (p[4] + p[18] * (-p[7] + u_x_p_v_y_p_w_z) + ((temp0 - p[15]) * p[1] + p[18] * (p[7] - p_19_p_1 - p_20_p_2)) * p[10] + p[11] * (p[12] - p[20] * temp1 + p[19] * point[2])) / p[0];
        point[1] = (p[5] + p[19] * (-p[8] + u_x_p_v_y_p_w_z) + ((temp1 - p[16]) * p[2] + p[19] * (p[8] - p_18_p_0 - p_20_p_2)) * p[10] + p[11] * (p[13] + p[20] * temp0 - p[18] * point[2])) / p[0];
        point[2] = (p[6] + p[20] * (-p[9] + u_x_p_v_y_p_w_z) + ((point[2] - p[17]) * p[3] + p[20] * (p[9] - p_18_p_0 - p_19_p_1)) * p[10] + p[11] * (p[14] - p[19] * temp0 + p[18] * temp1)) / p[0];
    }

    function translate(vector, point) {
        point[0] = point[0] + vector[0];
        point[1] = point[1] + vector[1];
        point[2] = point[2] + vector[2];
    }

    function scale(vector, point) {
        point[0] = point[0] * vector[0];
        point[1] = point[1] * vector[1];
        point[2] = point[2] * vector[2];
    }

    function translateObj(vector, obj) {
        translate(vector, obj.center);

        for (let i = 0; i < obj.points_number; i++) {
            translate(vector, obj.points[i]);
        }
    }

    function scaleObj(vector, obj) {
        for (let i = 0; i < obj.points_number; i++) {
            scale(vector, obj.points[i]);
        }
    }

    function rotateObj(parametri1, parametri2, obj) {
        rotate(parametri1, obj.center);
        rotate(parametri2, obj.axis_x);
        rotate(parametri2, obj.axis_y);
        rotate(parametri2, obj.axis_z);

        for (let i = 0; i < obj.faces_number; i++) {
            rotate(parametri2, obj.normals[i]);
        }

        for (let j = 0; j < obj.points_number; j++) {
            rotate(parametri1, obj.points[j]);
        }
    }

    function project(distance, point, x, y) {
      const result = [];

      result[0] = point[0] * distance / point[2] + x;
        result[1] = y - point[1] * distance / point[2];
        result[2] = distance;

        return result;
    }

    // sort function
    function sortByDistance(x, y) {
        return (y.distance - x.distance);
    }

    function hexToRgb(hex) {
      const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
      return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    // initialization
    if (window.attachEvent) {
        window.attachEvent('onload', sceneInit);
    } else {
        if (window.onload) {
          const curronload = window.onload;
          window.onload = function () {
                curronload();
                sceneInit();
            };
        } else {
            window.onload = sceneInit;
        }
    }
})();
